<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryValidatorInterface;

class QueryValidator implements CheckUnfollowingActionQueryValidatorInterface
{
    public function validate(CheckUnfollowingActionQueryInterface $query): ?array
    {
        if (!$query->getTargetUserToken()) {
            return ['targetUserToken' => 'TargetUserToken is required'];
        }

        if (!$query->getTargetUsername()) {
            return ['targetUsername' => 'TargetUsername is required'];
        }

        return null;
    }
}
