<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface CheckUnsubscribedActionResponseInterface
{
    /**
     * @return UserInterface[]
     */
    public function getItems(): array;
}
