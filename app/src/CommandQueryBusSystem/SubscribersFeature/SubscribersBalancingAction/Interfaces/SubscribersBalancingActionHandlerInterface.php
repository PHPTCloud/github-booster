<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionHandlerInterface
{
    public function handle(SubscribersBalancingActionCommandInterface $command): void;
}
