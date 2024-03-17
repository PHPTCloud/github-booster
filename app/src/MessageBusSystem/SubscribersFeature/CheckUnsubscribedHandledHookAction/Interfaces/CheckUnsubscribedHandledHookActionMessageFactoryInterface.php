<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;

interface CheckUnsubscribedHandledHookActionMessageFactoryInterface
{
    public function create(
        CheckUnsubscribedHandledHookActionCommandInterface $command,
    ): CheckUnsubscribedHandledHookActionMessageInterface;
}
