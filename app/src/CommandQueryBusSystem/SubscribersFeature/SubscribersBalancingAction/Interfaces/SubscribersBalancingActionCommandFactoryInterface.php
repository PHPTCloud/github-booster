<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionCommandFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscribersBalancingActionCommandInterface;
}
