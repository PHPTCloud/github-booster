<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\GithubFollowersFeature\Manager;

use App\InfrastructureSystem\GithubFollowersFeature\DataObject\Subscription;
use App\InfrastructureSystem\GithubFollowersFeature\Interfaces\GithubSubscribersManagerInterface;
use App\InfrastructureSystem\SerializerFeature\DeserializerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class SubscribersManager implements GithubSubscribersManagerInterface
{
    private readonly Client $client;

    public function __construct(
        private readonly DeserializerInterface $deserializer,
    ) {
        $this->client = new Client(['base_uri' => 'https://api.github.com']);
    }

    /**
     * @throws GuzzleException
     */
    public function getSubscriptions(
        string $token,
        int $page = 1,
        int $limit = 30,
    ): array {
        $response = $this->client->get('/user/following', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token,
            ],
            RequestOptions::QUERY => [
                'page' => $page,
                'per_page' => $limit,
            ],
        ]);

        return $this->deserializer->deserializeAsArray(
            $response->getBody()->getContents(),
            Subscription::class,
            DeserializerInterface::JSON_FORMAT,
        );
    }

    public function subscriptionCheck(
        string $token,
        string $targetUsername,
        string $username,
    ): bool {
        try {
            $response = $this->client->get(sprintf('/users/%s/following/%s', $username, $targetUsername), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
        } catch (RequestException $exception) {
            if ($exception->getResponse()->getStatusCode() === 404) {
                return false;
            }
            throw $exception;
        }

        return $response->getStatusCode() === 204;
    }
}
