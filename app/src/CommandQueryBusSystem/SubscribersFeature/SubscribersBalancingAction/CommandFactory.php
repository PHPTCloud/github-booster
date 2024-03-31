<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandInterface;

class CommandFactory implements SubscribersBalancingActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscribersBalancingActionCommandInterface
    {
        return new Command($targetUserToken, $targetUsername);
    }
}
