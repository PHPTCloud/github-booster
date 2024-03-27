<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

/**
 * @deprecated
 */
class Response implements CheckUnsubscribedActionResponseInterface
{
    public function __construct(
        private readonly array $items,
    ) {}

    public function getItems(): array
    {
        return $this->items;
    }
}
