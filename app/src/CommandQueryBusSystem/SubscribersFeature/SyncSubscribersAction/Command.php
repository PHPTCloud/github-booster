<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction;

use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandInterface;

class Command implements SyncSubscribersActionCommandInterface
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
