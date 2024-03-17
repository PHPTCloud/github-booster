<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces;

interface CheckUnsubscribedHandledHookActionHandlerInterface
{
    public function handle(
        array $users,
        string $targetUserToken,
        string $targetUsername,
        array $actions,
    ): void;
}
