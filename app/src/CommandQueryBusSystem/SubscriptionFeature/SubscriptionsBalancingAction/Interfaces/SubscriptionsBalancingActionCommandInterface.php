<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces;

interface SubscriptionsBalancingActionCommandInterface
{
    public function getTargetUsername(): string;

    public function getTargetUserToken(): string;
}
