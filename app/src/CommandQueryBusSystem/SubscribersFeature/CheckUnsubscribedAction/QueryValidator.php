<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryValidatorInterface;

/**
 * @deprecated
 */
class QueryValidator implements CheckUnsubscribedActionQueryValidatorInterface
{
    public function validate(CheckUnsubscribedActionQueryInterface $query): ?array
    {
        if (!$query->getTargetUserToken()) {
            return ['targetUserToken' => 'TargetUserToken обязательный параметр'];
        }

        if (!$query->getTargetUsername()) {
            return ['targetUsername' => 'TargetUsername обязательный параметр'];
        }

        if (!empty($query->getActions())) {
            $diff = array_diff($query->getActions(), ActionsEnum::getCases());
            if (!empty($diff)) {
                return [$diff[0] => sprintf('Неизвестное действие "%s".', $diff[0])];
            }
        }

        if ($query->getPage() < 1) {
            return ['page' => 'Cannot have negative value.'];
        }

        if ($query->getLimit() < 1) {
            return ['page' => 'Cannot have negative value.'];
        }

        return null;
    }
}
