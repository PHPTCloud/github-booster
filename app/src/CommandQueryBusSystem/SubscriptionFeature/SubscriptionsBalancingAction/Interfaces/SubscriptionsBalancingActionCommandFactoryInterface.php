<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces;

interface SubscriptionsBalancingActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscriptionsBalancingActionCommandInterface;
}
