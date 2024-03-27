<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandInterface;

class Command implements SyncSubscriptionsActionCommandInterface
{
    public function __construct(
        private readonly string $targetUserToken,
        private readonly string $targetUsername,
    ) {}

    public function getTargetUserToken(): string
    {
        return $this->targetUserToken;
    }

    public function getTargetUsername(): string
    {
        return $this->targetUsername;
    }
}
