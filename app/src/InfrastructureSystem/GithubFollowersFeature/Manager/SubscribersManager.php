<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\GithubFollowersFeature\Manager;

use App\InfrastructureSystem\GithubFollowersFeature\DataObject\Subscriber;
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

        $this->loggingRateLimitHeaders($response->getHeaders());

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

            $this->loggingRateLimitHeaders($response->getHeaders());
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

            $this->loggingRateLimitHeaders($response->getHeaders());
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

    private function loggingRateLimitHeaders(array $headers): void
    {
        $this->logger->debug('Значения Rate Limit.', [
            'Link' => $headers['Link'][0] ?? null,
            'X-RateLimit-Limit' => $headers['X-RateLimit-Limit'][0],
            'X-RateLimit-Remaining' => $headers['X-RateLimit-Remaining'][0],
            'X-RateLimit-Used' => $headers['X-RateLimit-Used'][0],
            'X-RateLimit-Reset' => (new \DateTime())->setTimestamp((int) $headers['X-RateLimit-Reset'][0])->format('Y-m-d H:i:s'),
        ]);
    }

    public function getSubscribers(string $token, int $page = 1, int $limit = 30): array
    {
        $response = $this->client->get('/user/followers', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $token,
            ],
            RequestOptions::QUERY => [
                'page' => $page,
                'per_page' => $limit,
            ],
        ]);

        $this->loggingRateLimitHeaders($response->getHeaders());

        $items = $this->deserializer->deserializeAsArray(
            $response->getBody()->getContents(),
            Subscriber::class,
            DeserializerInterface::JSON_FORMAT,
        );

        if (empty($items)) {
            throw new OutOfRangeException('Список подписок пуст.');
        }

        return $items;
    }

    public function subscribe(string $token, string $username): bool
    {
        try {
            $response = $this->client->put(sprintf('/user/following/%s', $username), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);

            $this->loggingRateLimitHeaders($response->getHeaders());
        } catch (RequestException $exception) {
            if ($exception->getResponse()->getStatusCode() === 304) {
                $this->logger->debug('Вызван метод подписка на пользователя, на которого уже есть подписка.', [
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
