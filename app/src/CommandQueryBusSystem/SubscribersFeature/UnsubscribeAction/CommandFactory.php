<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction;

use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandInterface;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
class CommandFactory implements UnsubscribeActionCommandFactoryInterface
{
    public function create(UserInterface $user, string $targetUserToken): UnsubscribeActionCommandInterface
    {
        return new Command($user, $targetUserToken);
    }
}
