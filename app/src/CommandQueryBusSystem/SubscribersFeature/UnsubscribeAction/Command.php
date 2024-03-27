<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction;

use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandInterface;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
class Command implements UnsubscribeActionCommandInterface
{
    public function __construct(
        private readonly UserInterface $user,
        private readonly string $targetUserToken,
    ) {}

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getTargetUserToken(): string
    {
        return $this->targetUserToken;
    }
}
