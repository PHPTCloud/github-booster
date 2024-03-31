<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SynchronizationFeature;

interface SynchronizationSubscriptionsManagerInterface
{
    public function syncSubscriptions(string $targetUserToken, string $targetUsername): void;
}
