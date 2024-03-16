<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

interface CheckUnfollowingActionQueryInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;
}
