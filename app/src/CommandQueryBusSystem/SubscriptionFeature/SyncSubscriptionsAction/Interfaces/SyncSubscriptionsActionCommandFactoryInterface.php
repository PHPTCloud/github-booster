<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces;

interface SyncSubscriptionsActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SyncSubscriptionsActionCommandInterface;
}
