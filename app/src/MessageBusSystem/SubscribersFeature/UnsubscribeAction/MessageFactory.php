<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageFactoryInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageInterface;

/**
 * @deprecated
 */
class MessageFactory implements UnsubscribeActionMessageFactoryInterface
{
    public function create(UserInterface $user, string $targetUserToken): UnsubscribeActionMessageInterface
    {
        return new Message($user, $targetUserToken);
    }
}
