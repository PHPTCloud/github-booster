<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryInterface;

class QueryFactory implements CheckUnfollowingActionQueryFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): CheckUnfollowingActionQueryInterface
    {
        return new Query($targetUserToken, $targetUsername);
    }
}
