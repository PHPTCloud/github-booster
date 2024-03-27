<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryInterface;

/**
 * @deprecated
 */
class QueryFactory implements CheckUnsubscribedActionQueryFactoryInterface
{
    public function create(
        string $targetUserToken,
        string $targetUsername,
        array $actions = [],
        int $page = 1,
        int $limit = 30,
    ): CheckUnsubscribedActionQueryInterface {
        return new Query($targetUserToken, $targetUsername, $actions, $page, $limit);
    }
}
