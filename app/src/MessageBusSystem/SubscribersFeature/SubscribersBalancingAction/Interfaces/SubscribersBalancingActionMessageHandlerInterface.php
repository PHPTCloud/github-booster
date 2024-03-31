<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionMessageHandlerInterface
{
    public function __invoke(SubscribersBalancingActionMessageInterface $message): void;
}
