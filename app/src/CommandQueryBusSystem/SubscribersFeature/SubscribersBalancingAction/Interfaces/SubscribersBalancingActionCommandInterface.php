<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionCommandInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;
}
