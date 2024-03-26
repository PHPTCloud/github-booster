<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces;

interface SyncSubscribersActionHandlerInterface
{
    public function handle(SyncSubscribersActionCommandInterface $command): void;
}
