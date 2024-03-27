<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
interface CheckUnsubscribedActionResponseFactoryInterface
{
    /**
     * @param UserInterface[] $items
     *
     * @return CheckUnsubscribedActionResponseInterface
     */
    public function create(array $items): CheckUnsubscribedActionResponseInterface;
}
