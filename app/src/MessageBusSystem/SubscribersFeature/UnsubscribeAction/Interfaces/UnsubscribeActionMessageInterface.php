<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\MessageBusSystem\SubscribersFeature\Interfaces\SubscribersFeatureActionHookMessageInterface;

/**
 * @deprecated
 */
interface UnsubscribeActionMessageInterface extends SubscribersFeatureActionHookMessageInterface
{
    public function getUser(): UserInterface;

    public function getTargetUserToken(): string;
}
