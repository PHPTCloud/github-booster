<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction;

use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandValidatorInterface;

/**
 * @deprecated
 */
class CommandValidator implements UnsubscribeActionCommandValidatorInterface
{
    public function validate(UnsubscribeActionCommandInterface $command): ?array
    {
        if ($command->getUser()->isSubscribed()) {
            return ['user' => 'User already following target user.'];
        }

        return null;
    }
}
