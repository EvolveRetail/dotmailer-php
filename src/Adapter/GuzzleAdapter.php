<?php

namespace Dotmailer\Adapter;

use Dotmailer\Dotmailer;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements Adapter
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $username
     * @param string $password
     * @param string $baseUri
     *
     * @return self
     */
    public static function fromCredentials(
        string $username,
        string $password,
        string $baseUri = Dotmailer::DEFAULT_URI
    ): self {
        $client = new Client(
            [
                'base_uri' => $baseUri,
                'auth' => [
                    $username,
                    $password,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]
        );

        return new self($client);
    }

    /**
     * @inheritdoc
     */
    public function get(string $url, array $params = []): ResponseInterface
    {
        return $this->client->request('GET', $url, ['query' => $params]);
    }

    /**
     * @inheritdoc
     */
    public function post(string $url, array $content = []): ResponseInterface
    {
        return $this->client->request('POST', $url, ['json' => $content]);
    }

    /**
     * @inheritdoc
     */
    public function put(string $url, array $content = []): ResponseInterface
    {
        return $this->client->request('PUT', $url, ['json' => $content]);
    }

    /**
     * @inheritdoc
     */
    public function delete(string $url): ResponseInterface
    {
        return $this->client->request('DELETE', $url);
    }
}
