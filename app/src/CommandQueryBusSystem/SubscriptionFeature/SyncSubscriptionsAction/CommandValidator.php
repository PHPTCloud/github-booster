<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandValidatorInterface;

class CommandValidator implements SyncSubscriptionsActionCommandValidatorInterface
{
    public function validate(SyncSubscriptionsActionCommandInterface $command): ?array
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
