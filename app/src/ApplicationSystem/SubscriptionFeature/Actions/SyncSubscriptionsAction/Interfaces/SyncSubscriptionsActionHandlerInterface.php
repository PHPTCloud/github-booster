<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\SyncSubscriptionsAction\Interfaces;

interface SyncSubscriptionsActionHandlerInterface
{
    public function handle(string $targetUserToken, string $targetUsername): void;
}
