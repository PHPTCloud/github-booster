<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature;

use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionHandlerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SubscribersManager implements SubscribersManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SyncSubscribersActionCommandFactoryInterface $syncSubscribersActionCommandFactory,
        private readonly SyncSubscribersActionHandlerInterface $syncSubscribersActionHandler,
    ) {}

    public function syncSubscribers(string $targetUserToken, string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->syncSubscribersActionHandler->handle($this->syncSubscribersActionCommandFactory->create(
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
