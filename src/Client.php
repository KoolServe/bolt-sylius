<?php

namespace Bolt\Extension\Koolserve\Sylius;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Sainsburys\Guzzle\Oauth2\GrantType\RefreshToken;
use Sainsburys\Guzzle\Oauth2\GrantType\PasswordCredentials;
use Sainsburys\Guzzle\Oauth2\Middleware\OAuthMiddleware;

class Client
{
    protected $client;

    protected $domain;

    protected $username;

    protected $password;

    protected $clientId;

    protected $clientSecret;

    public function getClient()
    {
        return $this->client;
    }

    protected function setClient($client)
    {
        $this->client = $client;
    }

    public function __construct($config)
    {
        $this->domain = $config['domain'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->clientId = $config['clientId'];
        $this->clientSecret = $config['clientSecret'];

        if ($this->getClient() === null) {
            $this->connect();
        }
    }

    public function get($url)
    {
        $client = $this->getClient();
        $response = $client->get($url);
        $data = json_decode($response->getBody() . '', true);

        return $data;
    }

    public function connect()
    {
        $baseURI = 'http://' . $this->domain . '/api/';
        $handlerStack = HandlerStack::create();
        $client = new GuzzleClient([
            'handler'=> $handlerStack,
            'base_uri' => $baseURI,
            'auth' => 'oauth2'
        ]);

        $config = [
            "username" => $this->username,
            "password" => $this->password,
            "client_id" => $this->clientId,
            'client_secret' => $this->clientSecret,
            "token_url" => 'oauth/v2/token',
        ];

        $token = new PasswordCredentials($client, $config);
        $refreshToken = new RefreshToken($client, $config);
        $middleware = new OAuthMiddleware($client, $token, $refreshToken);

        $handlerStack->push($middleware->onBefore());
        $handlerStack->push($middleware->onFailure(5));

        $this->client = $client;
    }
}