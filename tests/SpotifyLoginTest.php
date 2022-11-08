<?php

namespace PouleR\SpotifyLogin\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PouleR\SpotifyLogin\Exception\SpotifyLoginException;
use PouleR\SpotifyLogin\SpotifyLogin;
use PHPUnit\Framework\TestCase;
use PouleR\SpotifyLogin\SpotifyLoginClient;
use Spotify\Login5\V3\Challenge;
use Spotify\Login5\V3\Challenges;
use Spotify\Login5\V3\Challenges\HashcashChallenge;
use Spotify\Login5\V3\ChallengeSolution;
use Spotify\Login5\V3\LoginOk;
use Spotify\Login5\V3\LoginRequest;
use Spotify\Login5\V3\LoginResponse;

/**
 * Class SpotifyLoginTest
 */
class SpotifyLoginTest extends TestCase
{
    private SpotifyLoginClient|MockObject $loginClient;
    private SpotifyLogin $spotifyLogin;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->loginClient = $this->createMock(SpotifyLoginClient::class);
        $this->spotifyLogin = new SpotifyLogin($this->loginClient);

        $this->spotifyLogin->setClientId('client.id');
        $this->spotifyLogin->setDeviceId('device.id');
    }

    /**
     * @return void
     *
     * @throws SpotifyLoginException
     */
    public function testLogin(): void
    {
        $challenge = new Challenge();
        $hashCash = new HashcashChallenge();
        $hashCash
            ->setLength(10)
            ->setPrefix('00112233445566778899');

        $challenge->setHashcash($hashCash);
        $challenges = new Challenges();
        $challenges->setChallenges([$challenge]);

        $loginResponse = $this->createMock(LoginResponse::class);
        $loginResponse->expects(self::once())
            ->method('getChallenges')
            ->willReturn($challenges);

        $loginResponse->expects(self::exactly(2))
            ->method('getLoginContext')
            ->willReturn('some-context');

        $okResponse = new LoginOk();
        $okResponse
            ->setAccessToken('access.token')
            ->setUsername('user')
            ->setStoredCredential('refresh')
            ->setAccessTokenExpiresIn(3600);

        $tokenResponse = new LoginResponse();
        $tokenResponse->setOk($okResponse);

        $this->loginClient->expects(self::exactly(2))
            ->method('loginRequest')
            ->withConsecutive([
                self::callback(function (LoginRequest $request): bool {
                self::assertEquals('client.id', $request->getClientInfo()->getClientId());
                self::assertEquals('device.id', $request->getClientInfo()->getDeviceId());

                self::assertEquals('username', $request->getPassword()->getId());
                self::assertEquals('password', $request->getPassword()->getPassword());
                self::assertEquals(hex2bin('151515151515151515151515151515151515151515'), $request->getPassword()->getPadding());

                return true;
            })], [
                self::callback(function (LoginRequest $request): bool {
                    /** @var ChallengeSolution $hashSolution */
                    $hashSolution = $request->getChallengeSolutions()->getSolutions()[0];

                    self::assertEquals(hex2bin('5a8888c55ae342230000000000000c0d'), $hashSolution->getHashcash()->getSuffix());
                    self::assertNotEquals(0, $hashSolution->getHashcash()->getDuration()->getNanos());

                    return true;
                })
            ])
            ->willReturnOnConsecutiveCalls(
                $loginResponse,
                $tokenResponse
            );

        $accessToken = $this->spotifyLogin->login('username', 'password');

        self::assertEquals(3600, $accessToken->getExpiresIn());
        self::assertEquals('user', $accessToken->getUsername());
        self::assertEquals('refresh', $accessToken->getRefreshToken());
        self::assertEquals('access.token', $accessToken->getAccessToken());
    }

    /**
     * @return void
     *
     * @throws SpotifyLoginException
     */
    public function testRefreshToken(): void
    {
        $loginResponse = $this->createMock(LoginResponse::class);
        $loginResponse->expects(self::once())
            ->method('getOk')
            ->willReturn(null);

        $this->loginClient->expects(self::once())
            ->method('loginRequest')
            ->with(
                self::callback(function (LoginRequest $request): bool {
                    self::assertEquals('client.id', $request->getClientInfo()->getClientId());
                    self::assertEquals('device.id', $request->getClientInfo()->getDeviceId());

                    self::assertEquals('unit', $request->getStoredCredential()->getUsername());
                    self::assertEquals('test', $request->getStoredCredential()->getData());

                    return true;
                }))
            ->willReturn($loginResponse);

        self::assertNull($this->spotifyLogin->refreshToken('unit', 'test'));
    }
}
