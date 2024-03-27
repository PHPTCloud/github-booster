<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

/**
 * @deprecated
 */
interface CheckUnsubscribedHandledHookActionMessageHandlerInterface
{
    public function __invoke(CheckUnsubscribedHandledHookActionMessageInterface $message): void;
}
