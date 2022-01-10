<?php declare(strict_types=1);

namespace PouleR\SpotifyLogin;

use PouleR\SpotifyLogin\Exception\SpotifyLoginException;
use Spotify\Login5\V3\LoginError;
use Spotify\Login5\V3\LoginRequest;
use Spotify\Login5\V3\LoginResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class SpotifyLoginClient
 */
class SpotifyLoginClient
{
    private const LOGIN_URL = 'https://login5.spotify.com/v3/login';

    protected HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param LoginRequest $loginRequest
     *
     * @return LoginResponse
     *
     * @throws SpotifyLoginException
     */
    public function loginRequest(LoginRequest $loginRequest)
    {
        $headers[] = 'Content-Type: application/x-protobuf';

        try {
            $response = $this->httpClient->request(
                'POST',
                self::LOGIN_URL,
                [
                    'headers' => $headers,
                    'body' => $loginRequest->serializeToString(),
                ]
            );

            $loginResponse = new LoginResponse();
            $loginResponse->mergeFromString($response->getContent());

            if ($loginResponse->getError()) {
                throw new SpotifyLoginException('Response error: ' . LoginError::name($loginResponse->getError()));
            }

            return $loginResponse;
        } catch (ServerExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | TransportExceptionInterface | \Exception $exception) {
            throw new SpotifyLoginException(
                'Login request: ' . $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
