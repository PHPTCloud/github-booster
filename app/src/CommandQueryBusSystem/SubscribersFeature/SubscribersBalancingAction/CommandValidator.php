<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandValidatorInterface;

class CommandValidator implements SubscribersBalancingActionCommandValidatorInterface
{
    public function validate(SubscribersBalancingActionCommandInterface $command): ?array
    {
        if (!$command->getTargetUsername()) {
            return ['targetUsername' => 'TargetUsername обязательный параметр'];
        }

        if (!$command->getTargetUserToken()) {
            return ['targetUserToken' => 'TargetUserToken обязательный параметр'];
        }

        return null;
    }
}
