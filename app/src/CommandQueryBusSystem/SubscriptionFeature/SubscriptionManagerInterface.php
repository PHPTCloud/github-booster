<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature;

interface SubscriptionManagerInterface
{
    public function syncSubscriptions(string $targetUserToken, string $targetUsername): void;

    public function subscriptionsBalancing(string $targetUserToken, string $targetUsername): void;
}
