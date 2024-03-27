<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageFactoryInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageInterface;

/**
 * @deprecated
 */
class MessageFactory implements CheckUnsubscribedHandledHookActionMessageFactoryInterface
{
    public function create(CheckUnsubscribedHandledHookActionCommandInterface $command,): CheckUnsubscribedHandledHookActionMessageInterface
    {
        return new Message($command);
    }
}
