<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseInterface;

class Response implements CheckUnfollowingActionResponseInterface
{
    public function __construct(
        private readonly array $items,
    ) {}

    public function getItems(): array
    {
        return $this->items;
    }
}
