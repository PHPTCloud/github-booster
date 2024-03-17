<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

interface CheckUnsubscribedHandledHookActionCommandFactoryInterface
{
    public function create(
        ?CheckUnsubscribedActionResponseInterface $response = null,
        ?string $targetUserToken = null,
        ?string $targetUsername = null,
        ?array $actions = [],
    ): CheckUnsubscribedHandledHookActionCommandInterface;
}
