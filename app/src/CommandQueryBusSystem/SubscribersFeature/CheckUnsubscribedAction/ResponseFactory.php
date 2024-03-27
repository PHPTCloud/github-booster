<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

/**
 * @deprecated
 */
class ResponseFactory implements CheckUnsubscribedActionResponseFactoryInterface
{
    public function create(array $items): CheckUnsubscribedActionResponseInterface
    {
        return new Response($items);
    }
}
