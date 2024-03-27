<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces;

interface SyncSubscriptionsActionCommandInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;
}
