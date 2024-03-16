<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

interface CheckUnfollowingActionQueryFactoryInterface
{
    public function create(string $targetUserToken, string $targetUsername): CheckUnfollowingActionQueryInterface;
}
