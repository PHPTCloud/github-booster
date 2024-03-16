<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseItemFactoryInterface;

class ResponseFactory implements CheckUnfollowingActionResponseFactoryInterface
{
    public function create(array $items): CheckUnfollowingActionResponseInterface
    {
        return new Response($items);
    }
}
