<?php

namespace PouleR\SpotifyLogin\Tests\Entity;

use PouleR\SpotifyLogin\Entity\AccessToken;
use PHPUnit\Framework\TestCase;

/**
 * Class AccessTokenTest
 */
class AccessTokenTest extends TestCase
{
    private AccessToken $accessToken;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->accessToken = new AccessToken();
        $this->accessToken
            ->setUsername('username')
            ->setAccessToken('access.token')
            ->setExpiresIn(1800)
            ->setRefreshToken('refresh.token')
        ;
    }

    /**
     * @return void
     */
    public function testUsername(): void
    {
        self::assertEquals('username', $this->accessToken->getUsername());
    }

    /**
     * @return void
     */
    public function testAccessToken(): void
    {
        self::assertEquals('access.token', $this->accessToken->getAccessToken());
    }

    /**
     * @return void
     */
    public function testRefreshToken(): void
    {
        self::assertEquals('refresh.token', $this->accessToken->getRefreshToken());
    }

    /**
     * @return void
     */
    public function testExpiresIn(): void
    {
        self::assertEquals(1800, $this->accessToken->getExpiresIn());
    }
}
