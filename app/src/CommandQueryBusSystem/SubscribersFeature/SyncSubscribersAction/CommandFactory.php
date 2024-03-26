<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction;

use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandInterface;

class CommandFactory implements SyncSubscribersActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SyncSubscribersActionCommandInterface
    {
        return new Command($targetUserToken, $targetUsername);
    }
}
