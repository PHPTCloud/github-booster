<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

use App\InfrastructureSystem\EventDispatcherFeature\EventInterface;

interface CheckUnsubscribedActionHandledEventInterface extends EventInterface
{
    public function getTargetUserToken(): string;

    public function getTargetUsername(): string;

    public function getActions(): array;

    public function getResponse(): CheckUnsubscribedActionResponseInterface;
}
