<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;

/**
 * @deprecated
 */
interface CheckUnsubscribedHandledHookActionCommandInterface
{
    public function getTargetUserToken(): ?string;

    public function getTargetUsername(): ?string;

    public function getActions(): ?array;

    public function getResponse(): ?CheckUnsubscribedActionResponseInterface;
}
