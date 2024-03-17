<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

interface CheckUnsubscribedHandledHookActionMessageHandlerInterface
{
    public function __invoke(CheckUnsubscribedHandledHookActionMessageInterface $message): void;
}
