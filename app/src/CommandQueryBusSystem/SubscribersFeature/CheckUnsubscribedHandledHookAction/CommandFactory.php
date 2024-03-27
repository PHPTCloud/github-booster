<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;

/**
 * @deprecated
 */
class CommandFactory implements CheckUnsubscribedHandledHookActionCommandFactoryInterface
{
    public function create(
        ?CheckUnsubscribedActionResponseInterface $response = null,
        ?string $targetUserToken = null,
        ?string $targetUsername = null,
        ?array $actions = [],
    ): CheckUnsubscribedHandledHookActionCommandInterface {
        return new Command($response, $targetUserToken, $targetUsername, $actions);
    }
}
