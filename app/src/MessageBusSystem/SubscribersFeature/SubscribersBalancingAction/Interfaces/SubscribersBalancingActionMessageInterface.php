<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionMessageInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;
}
