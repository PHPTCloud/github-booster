<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
interface UnsubscribeActionMessageFactoryInterface
{
    public function create(UserInterface $user, string $targetUserToken): UnsubscribeActionMessageInterface;
}
