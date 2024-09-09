<?php

namespace Didntread\NetSapiens;

use Didntread\NetSapiens\Exceptions\ConfigurationException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const ENV_NETSAPIENS_CLIENT_ID = 'NETSAPIENS_CLIENT_ID';
    const ENV_NETSAPIENS_CLIENT_SECRET = 'NETSAPIENS_CLIENT_SECRET';
    const ENV_NETSAPIENS_USERNAME = 'NETSAPIENS_USERNAME';
    const ENV_NETSAPIENS_PASSWORD = 'NETSAPIENS_PASSWORD';
    const ENV_NETSAPIENS_HOST = 'NETSAPIENS_HOST';

    protected \GuzzleHttp\Client $client;

    protected string $client_id;
    protected string $client_secret;
    protected string $username;
    protected string $password;
    protected ?string $access_token;

    /***
     * Initializes the NetSapiens client
     * @param $username - Username to authenticate with
     * @param $password - Password to authenticate with
     * @param $baseUri - Base URI for the NetSapiens API
     * @throws ConfigurationException If valid authentication credentials are not provided
     */
    public function __construct(string $client_id = null, string $client_secret = null, string $username = null, string $password = null, string $baseUri = null)
    {
        $this->client_id = $client_id ?? getenv(self::ENV_NETSAPIENS_CLIENT_ID);
        $this->client_secret = $client_secret ?? getenv(self::ENV_NETSAPIENS_CLIENT_SECRET);
        $this->username = $username ?? getenv(self::ENV_NETSAPIENS_USERNAME);
        $this->password = $password ?? getenv(self::ENV_NETSAPIENS_PASSWORD);
        $this->access_token = null;

        if (!$this->client_id || !$this->client_secret || !$this->username || !$this->password) {
            throw new ConfigurationException('Credentials are required');
        }

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $baseUri ?? getenv(self::ENV_NETSAPIENS_HOST),
        ]);

        if (!$this->authenticate()) {
            throw new ConfigurationException('Invalid credentials');
        }
    }

    /**
     * Sends a request to the NetSapiens API
     * @param  string  $method  - HTTP method to use
     * @param  string  $uri  - URI to send the request to
     * @param  array  $params  - Query parameters to send with the request
     * @param  array  $data  - JSON data to send with the request
     * @param  array  $headers  - Headers to send with the request
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $params = [], array $data = [], array $headers = []): ResponseInterface
    {
        if (!\array_key_exists('Accept', $headers)) {
            $headers['Accept'] = 'application/json';
        }

        if (!\array_key_exists('Authorization', $headers) && $this->access_token) {
            $headers['Authorization'] = 'Bearer ' . $this->access_token;
        }

        return $this->getClient()->request($method, $uri, [
            'query' => $params,
            'json' => $data,
            'headers' => $headers,
        ]);
    }

    /***
     * Authenticates with the NetSapiens API
     * @return bool True if authentication was successful, false otherwise
     */
    private function authenticate(): bool
    {
        try {
            $response = $this->request('POST', 'v2/tokens', [], [
                'grant_type' => 'password',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'username' => $this->username,
                'password' => $this->password,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['access_token'])) {
                $this->access_token = $data['access_token'];
                return true;
            } else {
                return false;
            }
        } catch (GuzzleException $e) {
            return false;
        }
    }

    /***
     * Retrieve the username
     * @return string Current username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /***
     * Retrieve the password
     * @return string Current password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /***
     * Retrieve the http client
     * @return \GuzzleHttp\Client Current http client
     */
    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }

    /***
     * Retrieve the access token if authenticated
     * @return string|null Current access token or null if not authenticated
     */
    public function getAccessToken(): ?string
    {
        return $this->access_token;
    }

    public function domain(string $name): Context\DomainContext
    {
        return new Context\DomainContext($this, $name);
    }

    public function domains(): List\DomainList
    {
        return new List\DomainList($this);
    }

    public function subscription(string $id): Context\SubscriptionContext
    {
        return new Context\SubscriptionContext($this, $id);
    }

    public function subscriptions(): List\SubscriptionList
    {
        return new List\SubscriptionList($this);
    }

    public function __toString(): string {
        return '[NetSapiensClient ' . $this->getUsername() . ']';
    }
}
