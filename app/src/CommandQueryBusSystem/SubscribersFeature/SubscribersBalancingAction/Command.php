<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandInterface;

class Command implements SubscribersBalancingActionCommandInterface
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
