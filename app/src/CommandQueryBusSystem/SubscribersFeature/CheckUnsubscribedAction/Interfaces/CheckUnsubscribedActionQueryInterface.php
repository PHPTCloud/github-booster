<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

/**
 * @deprecated
 */
interface CheckUnsubscribedActionQueryInterface
{
    public function getTargetUserToken(): ?string;

    public function getTargetUsername(): ?string;

    public function getActions(): array;

    public function getPage(): int;

    public function getLimit(): int;
}
