<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\InfrastructureSystem\EventDispatcherFeature\EventDispatcherInterface;

class Handler implements CheckUnsubscribedHandledHookActionHandlerInterface
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {}

    public function handle(
        array $users,
        string $targetUserToken,
        string $targetUsername,
        array $actions,
    ): void {
        if (in_array(ActionsEnum::UNSUBSCRIBE->value, $actions, true)) {
            $this->eventDispatcher->dispatch(new UnsubscribeAfterCheckDefinedEvent($users, $targetUserToken));
        }
    }
}
