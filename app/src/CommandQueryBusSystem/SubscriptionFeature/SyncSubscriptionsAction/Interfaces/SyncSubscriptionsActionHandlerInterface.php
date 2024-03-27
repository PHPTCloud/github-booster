<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces;

interface SyncSubscriptionsActionHandlerInterface
{
    public function handle(SyncSubscriptionsActionCommandInterface $command): void;
}
