<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\GithubFollowersFeature\Manager;

use App\InfrastructureSystem\GithubFollowersFeature\DataObject\Subscription;
use App\InfrastructureSystem\GithubFollowersFeature\Interfaces\GithubSubscribersManagerInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Exception\OutOfRangeException;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;
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
        private readonly LoggerInterface $logger,
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

        $items = $this->deserializer->deserializeAsArray(
            $response->getBody()->getContents(),
            Subscription::class,
            DeserializerInterface::JSON_FORMAT,
        );

        if (empty($items)) {
            throw new OutOfRangeException('Список подписок пуст.');
        }

        return $items;
    }

    /**
     * @throws GuzzleException
     */
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
                $this->logger->debug('Вызван метод проверки подписки несуществующего пользователя.', [
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                return false;
            }
            throw $exception;
        }

        return $response->getStatusCode() === 204;
    }

    /**
     * @throws GuzzleException
     */
    public function unsubscribe(string $token, string $username): bool
    {
        try {
            $response = $this->client->delete(sprintf('/user/following/%s', $username), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $this->logger->debug('Попытка вызова метода отписки от пользователя.', [
                'username' => $username,
                'class' => __CLASS__,
                'method' => __METHOD__,
                'line' => __LINE__,
            ]);
        } catch (RequestException $exception) {
            if ($exception->getResponse()->getStatusCode() === 304) {
                $this->logger->debug('Вызван метод отписки от пользователя, на которого нет подписки.', [
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                return true;
            }
            throw $exception;
        }

        return $response->getStatusCode() === 204;
    }
}
