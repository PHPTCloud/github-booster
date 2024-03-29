<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces;

interface SubscriptionsBalancingActionCommandValidatorInterface
{
    public function validate(SubscriptionsBalancingActionCommandInterface $command): ?array;
}
