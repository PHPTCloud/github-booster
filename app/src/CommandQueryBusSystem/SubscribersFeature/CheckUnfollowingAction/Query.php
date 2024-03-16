<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryInterface;

class Query implements CheckUnfollowingActionQueryInterface
{
    public function __construct(
        private readonly ?string $targetUserToken = null,
        private readonly ?string $targetUsername = null,
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
