<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface CheckUnfollowingActionResponseInterface
{
    /**
     * @return UserInterface[]
     */
    public function getItems(): array;
}
