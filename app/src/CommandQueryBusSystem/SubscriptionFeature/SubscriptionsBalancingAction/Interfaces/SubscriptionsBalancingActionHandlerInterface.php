<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces;

interface SubscriptionsBalancingActionHandlerInterface
{
    public function handle(SubscriptionsBalancingActionCommandInterface $command): void;
}
