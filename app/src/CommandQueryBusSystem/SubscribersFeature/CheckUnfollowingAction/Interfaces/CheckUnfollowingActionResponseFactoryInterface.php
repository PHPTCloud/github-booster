<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface CheckUnfollowingActionResponseFactoryInterface
{
    /**
     * @param UserInterface[] $items
     *
     * @return CheckUnfollowingActionResponseInterface
     */
    public function create(array $items): CheckUnfollowingActionResponseInterface;
}
