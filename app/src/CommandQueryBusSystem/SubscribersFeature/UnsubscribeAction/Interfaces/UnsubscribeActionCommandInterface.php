<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
interface UnsubscribeActionCommandInterface
{
    public function getUser(): UserInterface;

    public function getTargetUserToken(): string;
}
