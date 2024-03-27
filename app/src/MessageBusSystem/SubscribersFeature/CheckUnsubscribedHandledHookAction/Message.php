<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageInterface;

/**
 * @deprecated
 */
class Message implements CheckUnsubscribedHandledHookActionMessageInterface
{
    public function __construct(
        private readonly CheckUnsubscribedHandledHookActionCommandInterface $command,
    ) {}

    public function getCommand(): CheckUnsubscribedHandledHookActionCommandInterface
    {
        return $this->command;
    }
}
