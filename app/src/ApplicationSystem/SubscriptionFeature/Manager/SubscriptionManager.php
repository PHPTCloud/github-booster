<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Manager;

use App\ApplicationSystem\SubscriptionFeature\Actions\RemoveAllSubscriptionsAction\Interfaces\RemoveAllSubscriptionsHandlerInterface;
use App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionHandlerInterface;
use App\ApplicationSystem\SubscriptionFeature\Actions\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;
use App\ApplicationSystem\SubscriptionFeature\Interfaces\Manager\SubscriptionManagerInterface;
use App\ApplicationSystem\SynchronizationFeature\SynchronizationSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SubscriptionManager implements SubscriptionManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SynchronizationSubscribersManagerInterface $synchronizationSubscribersManager,
        private readonly SyncSubscriptionsActionHandlerInterface $syncSubscriptionsActionHandler,
        private readonly RemoveAllSubscriptionsHandlerInterface $removeAllSubscriptionsHandler,
        private readonly SubscriptionsBalancingActionHandlerInterface $subscriptionsBalancingActionHandler,
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

    public function removeSubscriptionsByTargetUsername(string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->removeAllSubscriptionsHandler->handle($targetUsername);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }

    public function subscriptionsBalancing(string $targetUserToken, string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->logger->debug('Старт синхронизации подписок целевого пользователя.', [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->syncSubscriptions($targetUserToken, $targetUsername);

        $this->logger->debug('Старт синхронизации подписчиков целевого пользователя.', [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->synchronizationSubscribersManager->syncSubscribers($targetUserToken, $targetUsername);

        $this->logger->debug('Старт балансировки подписок.', [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->subscriptionsBalancingActionHandler->handle($targetUserToken, $targetUsername);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
