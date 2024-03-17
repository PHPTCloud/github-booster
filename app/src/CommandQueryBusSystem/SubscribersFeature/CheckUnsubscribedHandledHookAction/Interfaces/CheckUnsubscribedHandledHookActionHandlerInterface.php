<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

interface CheckUnsubscribedHandledHookActionHandlerInterface
{
    public function handle(CheckUnsubscribedHandledHookActionCommandInterface $command): void;
}
