<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature;

interface SubscribersManagerInterface
{
    public function syncSubscribers(string $targetUserToken, string $targetUsername): void;

    public function subscribersBalancing(string $targetUserToken, string $targetUsername): void;
}
