<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\ApplicationSystem\SubscribersFeature\Enums\ActionsEnum;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandValidatorInterface;

/**
 * @deprecated
 */
class CommandValidator implements CheckUnsubscribedHandledHookActionCommandValidatorInterface
{
    public function validate(CheckUnsubscribedHandledHookActionCommandInterface $command): ?array
    {
        if (empty($command->getResponse()?->getItems())) {
            return ['response.items' => 'Список не подписанных пользователей пуст.'];
        }

        if (!$command->getTargetUserToken()) {
            return ['targetUserToken' => 'TargetUserToken обязательный параметр'];
        }

        if (!$command->getTargetUsername()) {
            return ['targetUsername' => 'TargetUsername обязательный параметр'];
        }

        if (!empty($command->getActions())) {
            $diff = array_diff($command->getActions(), ActionsEnum::getCases());
            if (!empty($diff)) {
                return [$diff[0] => sprintf('Неизвестное действие "%s".', $diff[0])];
            }
        }

        return null;
    }
}
