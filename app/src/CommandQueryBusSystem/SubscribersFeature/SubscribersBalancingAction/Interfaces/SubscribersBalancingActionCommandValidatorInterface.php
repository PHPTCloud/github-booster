<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionCommandValidatorInterface
{
    public function validate(SubscribersBalancingActionCommandInterface $command): ?array;
}
