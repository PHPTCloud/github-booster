<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Manager;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Actions\UnsubscribeAction\Interfaces\UnsubscribeActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

class SubscribersManager implements SubscribersManagerInterface
{
    public function __construct(
        private readonly CheckUnsubscribedActionHandlerInterface $checkUnsubscribedActionHandler,
        private readonly CheckUnsubscribedHandledHookActionHandlerInterface $checkUnsubscribedHandledHookActionHandler,
        private readonly UnsubscribeActionHandlerInterface $unsubscribeActionHandler,
    ) {}

    public function checkUnsubscribed(
        string $targetUserToken,
        string $targetUsername,
        int $page = 1,
        int $limit = 100,
    ): array {
        return $this->checkUnsubscribedActionHandler->handle($targetUserToken, $targetUsername, $page, $limit);
    }

    public function handleCheckUnsubscribedHandledHook(
        array $users,
        string $targetUserToken,
        string $targetUsername,
        array $actions,
    ): void {
        $this->checkUnsubscribedHandledHookActionHandler->handle($users, $targetUserToken, $targetUsername, $actions);
    }

    public function unsubscribe(UserInterface $user, string $targetUserToken): void
    {
        $this->unsubscribeActionHandler->handle($user, $targetUserToken);
    }
}
