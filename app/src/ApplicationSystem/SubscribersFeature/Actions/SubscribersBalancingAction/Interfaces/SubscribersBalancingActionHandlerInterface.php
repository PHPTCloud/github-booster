<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\SubscribersBalancingAction\Interfaces;

interface SubscribersBalancingActionHandlerInterface
{
    public function handle(string $targetUserToken, string $targetUsername): void;
}
