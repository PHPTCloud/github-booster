<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionMessageFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): SubscribersBalancingActionMessageInterface;
}
