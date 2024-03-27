<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;

/**
 * @deprecated
 */
class Command implements CheckUnsubscribedHandledHookActionCommandInterface
{
    public function __construct(
        private readonly ?CheckUnsubscribedActionResponseInterface $response = null,
        private readonly ?string $targetUserToken = null,
        private readonly ?string $targetUsername = null,
        private readonly ?array $actions = [],
    ) {}

    public function getResponse(): ?CheckUnsubscribedActionResponseInterface
    {
        return $this->response;
    }

    public function getTargetUserToken(): ?string
    {
        return $this->targetUserToken;
    }

    public function getTargetUsername(): ?string
    {
        return $this->targetUsername;
    }

    public function getActions(): ?array
    {
        return $this->actions;
    }
}
