# Spotify Login

This is a PHP wrapper for a Spotify login.

## Requirements
* PHP >=8.1

## Installation
Install it using [Composer](https://getcomposer.org/):

```sh
composer require pouler/spotify-login
```
## Compiling .proto files
- Originally taken from this repository: https://github.com/librespot-org/librespot-java/tree/dev/lib/src/main/proto/spotify/login5/v3
- Make sure you have the protoc compiler installed
- The .proto files are used for generating the PHP classes

`protoc --php_out=./generated --proto_path=./proto \ 
  proto/spotify/login5/v3/login5.proto \
  proto/spotify/login5/v3/user_info.proto \
  proto/spotify/login5/v3/client_info.proto \
  proto/spotify/login5/v3/challenges/code.proto \
  proto/spotify/login5/v3/challenges/hashcash.proto \
  proto/spotify/login5/v3/credentials/credentials.proto \
  proto/spotify/login5/v3/identifiers/identifiers.proto`

## Example usage
```php
<?php declare(strict_types=1);

require 'vendor/autoload.php';

$httpClient = new \Symfony\Component\HttpClient\CurlHttpClient();
$client = new \PouleR\SpotifyLogin\SpotifyLoginClient($httpClient);
$spotifyLogin = new \PouleR\SpotifyLogin\SpotifyLogin($client);

$spotifyLogin->setClientId('clientId');
$spotifyLogin->setDeviceId('deviceId');

// Log in and get the access token
$token = $spotifyLogin->login('email@address.com','password');

// Refresh token
$newToken = $spotifyLogin->refreshToken($token->getUsername(), $token->getRefreshToken());

print_r($newToken);
```
