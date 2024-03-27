<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandledEventInterface;

/**
 * @deprecated
 */
interface CheckUnsubscribedHandledHookActionListenerInterface
{
    public function __invoke(CheckUnsubscribedActionHandledEventInterface $event): void;
}
