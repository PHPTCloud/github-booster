<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscribersAction\Interfaces;

interface SyncSubscribersActionHandlerInterface
{
    public function handle(string $targetUserToken, string $targetUsername): void;
}
