<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface UnsubscribeActionCommandFactoryInterface
{
    public function create(UserInterface $user, string $targetUserToken): UnsubscribeActionCommandInterface;
}
