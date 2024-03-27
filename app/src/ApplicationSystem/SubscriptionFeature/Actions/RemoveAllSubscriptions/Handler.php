<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\RemoveAllSubscriptions;

use App\ApplicationSystem\SubscriptionFeature\Actions\RemoveAllSubscriptions\Interfaces\RemoveAllSubscriptionsHandlerInterface;
use App\DomainSystem\SubscriptionFeature\Storage\SubscriptionStorageInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements RemoveAllSubscriptionsHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SubscriptionStorageInterface $subscriptionStorage,
    ) {}

    /**
     * @throws \Throwable
     */
    public function handle(string $targetUserName): void
    {
        try {
            $this->subscriptionStorage->removeByTargetUsername($targetUserName);
        } catch (\Throwable $exception) {
            $this->logger->debug('При удалении подписок произошла непредвиденная ошибка.', [
                'arguments' => func_get_args(),
                'exception' => [
                    'message' => $exception->getMessage(),
                    'class' => get_class($exception),
                    'code' => $exception->getCode(),
                ],
                'class' => __CLASS__,
                'method' => __METHOD__,
                'line' => __LINE__,
            ]);
            throw $exception;
        }
    }
}
