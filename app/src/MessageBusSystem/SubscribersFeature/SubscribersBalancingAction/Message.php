<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageInterface;

class Message implements SubscribersBalancingActionMessageInterface
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
