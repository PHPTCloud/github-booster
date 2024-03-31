<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SynchronizationFeature;

use App\ApplicationSystem\SubscriptionFeature\Actions\RemoveAllSubscriptionsAction\Interfaces\RemoveAllSubscriptionsHandlerInterface;
use App\ApplicationSystem\SubscriptionFeature\Actions\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SynchronizationSubscriptionsManager implements SynchronizationSubscriptionsManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SyncSubscriptionsActionHandlerInterface $syncSubscriptionsActionHandler,
        private readonly RemoveAllSubscriptionsHandlerInterface $removeAllSubscriptionsHandler,
    ) {}

    public function syncSubscriptions(string $targetUserToken, string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->logger->debug('Удаление списка подписок целевого пользователя из БД.', [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->removeAllSubscriptionsHandler->handle($targetUsername);

        $this->logger->debug('Получение нового списка подписок целевого пользователя и сохранение его в БД.', [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->syncSubscriptionsActionHandler->handle($targetUserToken, $targetUsername);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
