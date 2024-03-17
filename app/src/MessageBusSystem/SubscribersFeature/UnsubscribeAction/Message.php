<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageInterface;

class Message implements UnsubscribeActionMessageInterface
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
