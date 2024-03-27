<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\UnsubscribeAction;

use App\ApplicationSystem\SubscribersFeature\Actions\UnsubscribeAction\Interfaces\UnsubscribeActionHandlerInterface;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;

/**
 * @deprecated
 */
class Handler implements UnsubscribeActionHandlerInterface
{
    public function __construct(
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
    ) {}

    public function handle(UserInterface $user, string $targetUserToken): void
    {
        $this->internalSubscribersManager->unsubscribe($targetUserToken, $user->getLogin());
    }
}
