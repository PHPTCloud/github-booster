<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandInterface;

class CommandFactory implements SyncSubscriptionsActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SyncSubscriptionsActionCommandInterface
    {
        return new Command($targetUserToken, $targetUsername);
    }
}
