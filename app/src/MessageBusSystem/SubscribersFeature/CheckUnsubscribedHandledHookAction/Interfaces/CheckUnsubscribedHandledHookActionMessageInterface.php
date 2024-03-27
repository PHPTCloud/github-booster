<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;
use App\MessageBusSystem\SubscribersFeature\Interfaces\SubscribersFeatureActionHookMessageInterface;

/**
 * @deprecated
 */
interface CheckUnsubscribedHandledHookActionMessageInterface extends SubscribersFeatureActionHookMessageInterface
{
    public function getCommand(): CheckUnsubscribedHandledHookActionCommandInterface;
}
