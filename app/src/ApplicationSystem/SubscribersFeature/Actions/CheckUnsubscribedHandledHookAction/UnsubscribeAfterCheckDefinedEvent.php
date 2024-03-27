<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\UnsubscribeAfterCheckDefinedEventInterface;

/**
 * @deprecated
 */
class UnsubscribeAfterCheckDefinedEvent implements UnsubscribeAfterCheckDefinedEventInterface
{
    public function __construct(
        private readonly array $users,
        private readonly string $targetUserToken,
    ) {}

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getTargetUserToken(): string
    {
        return $this->targetUserToken;
    }

    public function getName(): string
    {
        return self::class;
    }
}
