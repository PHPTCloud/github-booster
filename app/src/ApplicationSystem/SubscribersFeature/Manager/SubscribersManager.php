<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Manager;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\RemoveAllSubscribersAction\Interfaces\RemoveAllSubscribersHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscribersAction\Interfaces\SyncSubscribersActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\UnsubscribeAction\Interfaces\UnsubscribeActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class SubscribersManager implements SubscribersManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CheckUnsubscribedActionHandlerInterface $checkUnsubscribedActionHandler,
        private readonly CheckUnsubscribedHandledHookActionHandlerInterface $checkUnsubscribedHandledHookActionHandler,
        private readonly UnsubscribeActionHandlerInterface $unsubscribeActionHandler,
        private readonly SyncSubscribersActionHandlerInterface $syncSubscribersActionHandler,
        private readonly RemoveAllSubscribersHandlerInterface $removeAllSubscribersHandler,
    ) {}

    /**
     * @deprecated
     */
    public function checkUnsubscribed(
        string $targetUserToken,
        string $targetUsername,
        int $page = 1,
        int $limit = 100,
    ): array {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $response = $this->checkUnsubscribedActionHandler->handle($targetUserToken, $targetUsername, $page, $limit);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        return $response;
    }

    /**
     * @deprecated
     */
    public function handleCheckUnsubscribedHandledHook(
        array $users,
        string $targetUserToken,
        string $targetUsername,
        array $actions,
    ): void {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->checkUnsubscribedHandledHookActionHandler->handle($users, $targetUserToken, $targetUsername, $actions);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }

    /**
     * @deprecated
     */
    public function unsubscribe(UserInterface $user, string $targetUserToken): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->unsubscribeActionHandler->handle($user, $targetUserToken);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }

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

    public function removeAllSubscribers(string $targetUsername): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->removeAllSubscribersHandler->handle($targetUsername);

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
