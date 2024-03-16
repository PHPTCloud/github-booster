<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

interface CheckUnfollowingActionHandlerInterface
{
    public function handle(CheckUnfollowingActionQueryInterface $query): CheckUnfollowingActionResponseInterface;
}
