<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

/**
 * @deprecated
 */
interface CheckUnsubscribedActionQueryFactoryInterface
{
    public function create(
        string $targetUserToken,
        string $targetUsername,
        array $actions = [],
        int $page = 1,
        int $limit = 30,
    ): CheckUnsubscribedActionQueryInterface;
}
