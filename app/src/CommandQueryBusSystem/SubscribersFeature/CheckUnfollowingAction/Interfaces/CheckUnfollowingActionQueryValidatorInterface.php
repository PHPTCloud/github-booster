<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

interface CheckUnfollowingActionQueryValidatorInterface
{
    public function validate(CheckUnfollowingActionQueryInterface $query): ?array;
}
