<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandInterface;

class CommandFactory implements SubscriptionsBalancingActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscriptionsBalancingActionCommandInterface
    {
        return new Command($targetUserToken, $targetUsername);
    }
}
