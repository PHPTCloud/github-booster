<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SynchronizationFeature;

interface SynchronizationSubscribersManagerInterface
{
    public function syncSubscribers(string $targetUserToken, string $targetUsername): void;
}
