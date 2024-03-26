<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction;

use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandValidatorInterface;

class CommandValidator implements SyncSubscribersActionCommandValidatorInterface
{
    public function validate(SyncSubscribersActionCommandInterface $command): ?array
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
