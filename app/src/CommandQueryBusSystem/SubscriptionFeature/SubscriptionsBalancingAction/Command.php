<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction;

use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandInterface;

class Command implements SubscriptionsBalancingActionCommandInterface
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
