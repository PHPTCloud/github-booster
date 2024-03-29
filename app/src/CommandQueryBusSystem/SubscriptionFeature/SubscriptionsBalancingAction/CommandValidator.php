<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandValidatorInterface;

class CommandValidator implements SubscriptionsBalancingActionCommandValidatorInterface
{
    public function validate(SubscriptionsBalancingActionCommandInterface $command): ?array
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
