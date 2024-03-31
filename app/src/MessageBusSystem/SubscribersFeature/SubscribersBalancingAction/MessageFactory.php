<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageFactoryInterface;
use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageInterface;

class MessageFactory implements SubscribersBalancingActionMessageFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscribersBalancingActionMessageInterface
    {
        return new Message($targetUserToken, $targetUsername);
    }
}
