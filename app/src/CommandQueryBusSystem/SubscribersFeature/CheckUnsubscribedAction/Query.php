<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryInterface;

class Query implements CheckUnsubscribedActionQueryInterface
{
    public function __construct(
        private readonly ?string $targetUserToken = null,
        private readonly ?string $targetUsername = null,
        private readonly array $actions = [],
        private readonly int $page = 1,
        private readonly int $limit = 100,
    ) {}

    public function getTargetUserToken(): ?string
    {
        return $this->targetUserToken;
    }

    public function getTargetUsername(): ?string
    {
        return $this->targetUsername;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
