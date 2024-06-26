<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature;

use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionHandlerInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SubscriptionManager implements SubscriptionManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SyncSubscriptionsActionCommandFactoryInterface $syncSubscriptionsActionCommandFactory,
        private readonly SyncSubscriptionsActionHandlerInterface $syncSubscriptionsActionHandler,
        private readonly SubscriptionsBalancingActionCommandFactoryInterface $subscriptionsBalancingActionCommandFactory,
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

        $this->syncSubscriptionsActionHandler->handle($this->syncSubscriptionsActionCommandFactory->create(
            $targetUserToken,
            $targetUsername,
        ));

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

        $this->subscriptionsBalancingActionHandler->handle($this->subscriptionsBalancingActionCommandFactory->create(
            $targetUserToken,
            $targetUsername,
        ));

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
