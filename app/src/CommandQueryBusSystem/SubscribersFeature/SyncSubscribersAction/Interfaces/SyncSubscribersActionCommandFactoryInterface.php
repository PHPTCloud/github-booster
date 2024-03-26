<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces;

interface SyncSubscribersActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SyncSubscribersActionCommandInterface;
}
