<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

class ResponseFactory implements CheckUnsubscribedActionResponseFactoryInterface
{
    public function create(array $items): CheckUnsubscribedActionResponseInterface
    {
        return new Response($items);
    }
}
