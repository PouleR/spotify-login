<?php declare(strict_types=1);

namespace PouleR\SpotifyLogin;

use Exception;
use Google\Protobuf\Duration;
use PouleR\SpotifyLogin\Entity\AccessToken;
use PouleR\SpotifyLogin\Exception\SpotifyLoginException;
use PouleR\SpotifyLogin\Util\HexUtils;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Spotify\Login5\V3\Challenge;
use Spotify\Login5\V3\Challenges\HashcashSolution;
use Spotify\Login5\V3\ChallengeSolution;
use Spotify\Login5\V3\ChallengeSolutions;
use Spotify\Login5\V3\ClientInfo;
use Spotify\Login5\V3\Credentials\Password;
use Spotify\Login5\V3\Credentials\StoredCredential;
use Spotify\Login5\V3\LoginOk;
use Spotify\Login5\V3\LoginRequest;
use Spotify\Login5\V3\LoginResponse;

/**
 * Class SpotifyLogin
 */
class SpotifyLogin
{
    private string $clientId = '';
    private string $deviceId = '';

    protected SpotifyLoginClient $client;
    protected ?LoggerInterface $logger = null;

    /**
     * @param SpotifyLoginClient   $client
     * @param LoggerInterface|null $logger
     */
    public function __construct(SpotifyLoginClient $client, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger;

        if (!$this->logger) {
            $this->logger = new NullLogger();
        }
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId): void
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @param string $username
     * @param string $refreshToken
     *
     * @return AccessToken|null
     *
     * @throws SpotifyLoginException
     */
    public function refreshToken(string $username, string $refreshToken): ?AccessToken
    {
        $clientInfo = new ClientInfo();
        $clientInfo->setClientId($this->clientId);
        $clientInfo->setDeviceId($this->deviceId);

        $storedCredential = new StoredCredential();
        $storedCredential->setUsername($username);
        $storedCredential->setData($refreshToken);

        $loginRequest = new LoginRequest();
        $loginRequest->setClientInfo($clientInfo);
        $loginRequest->setStoredCredential($storedCredential);

        $loginResponse = $this->client->loginRequest($loginRequest);

        return $this->createAccessToken($loginResponse->getOk());
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return AccessToken|null
     *
     * @throws SpotifyLoginException
     */
    public function login(string $username, string $password): ?AccessToken
    {
        $clientInfo = new ClientInfo();
        $clientInfo->setClientId($this->clientId);
        $clientInfo->setDeviceId($this->deviceId);

        $spotifyPassword = new Password();
        $spotifyPassword->setId($username);
        $spotifyPassword->setPassword($password);
        $spotifyPassword->setPadding(hex2bin('151515151515151515151515151515151515151515'));

        $loginRequest = new LoginRequest();
        $loginRequest->setClientInfo($clientInfo);
        $loginRequest->setPassword($spotifyPassword);

        // Log in and get the loginContext and hashCash
        $loginResponse = $this->client->loginRequest($loginRequest);
        $challengeSolutions = $this->solveHashCashChallenge($loginResponse);

        $loginRequest->setLoginContext($loginResponse->getLoginContext());
        $loginRequest->setChallengeSolutions($challengeSolutions);

        // Send challengeSolutions and get access token
        $loginResponse = $this->client->loginRequest($loginRequest);

        return $this->createAccessToken($loginResponse->getOk());
    }

    /**
     * @param LoginResponse $loginResponse
     *
     * @return ChallengeSolutions
     *
     * @throws Exception
     */
    private function solveHashCashChallenge(LoginResponse $loginResponse): ChallengeSolutions
    {
        /** @var Challenge $hashCashChallenge */
        $hashCashChallenge = $loginResponse->getChallenges()->getChallenges()[0];
        $hashCash = $hashCashChallenge->getHashcash();

        $challengeSolver = new ChallengeSolver();
        $solvedChallenge = $challengeSolver->solveChallenge(
            $loginResponse->getLoginContext(),
            $hashCash->getPrefix(),
            $hashCash->getLength()
        );

        $hashCashSolution = new HashcashSolution();
        $hashCashSolution->setSuffix(hex2bin(HexUtils::byteArray2Hex($solvedChallenge->getSuffix())));

        $duration = new Duration();
        $duration
            ->setNanos(($solvedChallenge->getDuration() % 1000000000))
            ->setSeconds((int)($solvedChallenge->getDuration() / 1000000000));
        $hashCashSolution->setDuration($duration);

        $challengeSolution = new ChallengeSolution();
        $challengeSolution->setHashcash($hashCashSolution);

        $challengeSolutions = new ChallengeSolutions();
        $challengeSolutions->setSolutions([$challengeSolution]);

        return $challengeSolutions;
    }

    /**
     * @param LoginOk|null $okResponse
     *
     * @return AccessToken|null
     */
    private function createAccessToken(?LoginOk $okResponse): ?AccessToken
    {
        if (!$okResponse) {
            return null;
        }

        $spotifyAccessToken = new AccessToken();

        return $spotifyAccessToken
            ->setAccessToken($okResponse->getAccessToken())
            ->setExpiresIn($okResponse->getAccessTokenExpiresIn())
            ->setRefreshToken($okResponse->getStoredCredential())
            ->setUsername($okResponse->getUsername());
    }
}
