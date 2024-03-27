<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

/**
 * @deprecated
 */
interface CheckUnsubscribedActionHandlerInterface
{
    public function handle(CheckUnsubscribedActionQueryInterface $query): CheckUnsubscribedActionResponseInterface;
}
