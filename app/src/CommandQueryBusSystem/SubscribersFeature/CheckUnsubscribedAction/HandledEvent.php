<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandledEventInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

class HandledEvent implements CheckUnsubscribedActionHandledEventInterface
{
    public function __construct(
        private readonly CheckUnsubscribedActionResponseInterface $response,
        private readonly string $targetUserToken,
        private readonly string $targetUsername,
        private readonly array $actions = [],
    ) {}

    public function getTargetUserToken(): string
    {
        return $this->targetUserToken;
    }

    public function getTargetUsername(): string
    {
        return $this->targetUsername;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getName(): string
    {
        return self::class;
    }

    public function getResponse(): CheckUnsubscribedActionResponseInterface
    {
        return $this->response;
    }
}
