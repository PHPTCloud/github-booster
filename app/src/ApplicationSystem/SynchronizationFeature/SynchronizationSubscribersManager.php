<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SynchronizationFeature;

use App\ApplicationSystem\SubscribersFeature\Actions\RemoveAllSubscribersAction\Interfaces\RemoveAllSubscribersHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscribersAction\Interfaces\SyncSubscribersActionHandlerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SynchronizationSubscribersManager implements SynchronizationSubscribersManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SyncSubscribersActionHandlerInterface $syncSubscribersActionHandler,
        private readonly RemoveAllSubscribersHandlerInterface $removeAllSubscribersHandler,
    ) {}

    public function syncSubscribers(string $targetUserToken, string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->logger->debug('Удаление списка подписчиков целевого пользователя из БД.', [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->removeAllSubscribersHandler->handle($targetUsername);

        $this->logger->debug('Получение нового списка подписчиков целевого пользователя и сохранение его в БД.', [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->syncSubscribersActionHandler->handle($targetUserToken, $targetUsername);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
