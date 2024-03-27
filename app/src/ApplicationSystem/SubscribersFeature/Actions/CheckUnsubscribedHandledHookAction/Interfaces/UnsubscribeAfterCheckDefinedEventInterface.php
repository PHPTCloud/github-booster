<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\InfrastructureSystem\EventDispatcherFeature\EventInterface;

/**
 * @deprecated
 */
interface UnsubscribeAfterCheckDefinedEventInterface extends EventInterface
{
    public function getTargetUserToken(): string;

    /**
     * @return UserInterface[]
     */
    public function getUsers(): array;
}
