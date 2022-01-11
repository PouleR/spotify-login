<?php

namespace PouleR\SpotifyLogin\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PouleR\SpotifyLogin\Exception\SpotifyLoginException;
use PouleR\SpotifyLogin\SpotifyLoginClient;
use PHPUnit\Framework\TestCase;
use Spotify\Login5\V3\ClientInfo;
use Spotify\Login5\V3\LoginRequest;
use Spotify\Login5\V3\LoginResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class SpotifyLoginClientTest
 */
class SpotifyLoginClientTest extends TestCase
{
    /**
     * @var MockObject|HttpClientInterface
     */
    private $client;
    private SpotifyLoginClient $loginClient;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->client = $this->createMock(HttpClientInterface::class);
        $this->loginClient = new SpotifyLoginClient($this->client);
    }

    /**
     * @return void
     *
     * @throws SpotifyLoginException
     */
    public function testLoginRequest(): void
    {
        $clientInfo = new ClientInfo();
        $clientInfo
            ->setClientId('client.id')
            ->setDeviceId('device.id');

        $request = new LoginRequest();
        $request->setClientInfo($clientInfo);

        $loginResponse = new LoginResponse();
        $loginResponse->setLoginContext('test');
        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::once())
            ->method('getContent')
            ->willReturn($loginResponse->serializeToString());

        $this->client->expects(self::once())
            ->method('request')
            ->with('POST', 'https://login5.spotify.com/v3/login', ['headers' => ['Content-Type: application/x-protobuf'], 'body' => $request->serializeToString()])
            ->willReturn($response);

         $response = $this->loginClient->loginRequest($request);
         self::assertEquals('test', $response->getLoginContext());
    }

    /**
     * @return void
     */
    public function testLoginRequestErrorResponse(): void
    {
        $loginResponse = new LoginResponse();
        $loginResponse->setError(1);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::once())
            ->method('getContent')
            ->willReturn($loginResponse->serializeToString());

        $this->client->expects(self::once())
            ->method('request')
            ->willReturn($response);

        $this->expectException(SpotifyLoginException::class);
        $this->expectExceptionMessage('Login request: Response error: INVALID_CREDENTIALS');

        $this->loginClient->loginRequest(new LoginRequest());
    }

    /**
     * @return void
     */
    public function testLoginRequestException(): void
    {
        $this->client->expects(self::once())
            ->method('request')
            ->willThrowException(new \Exception('Whoops', 500));

        $this->expectException(SpotifyLoginException::class);
        $this->expectExceptionMessage('Login request: Whoops');
        $this->expectExceptionCode(500);

        $this->loginClient->loginRequest(new LoginRequest());
    }
}
