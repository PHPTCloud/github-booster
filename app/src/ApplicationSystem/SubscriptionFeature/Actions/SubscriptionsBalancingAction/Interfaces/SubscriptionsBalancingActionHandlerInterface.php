<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction\Interfaces;

interface SubscriptionsBalancingActionHandlerInterface
{
    public function handle(string $targetUserToken, string $targetUsername): void;
}
