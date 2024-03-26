<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces;

interface SyncSubscribersActionCommandInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;
}
