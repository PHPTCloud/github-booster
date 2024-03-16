<?php
declare(strict_types=1);

namespace App\DomainSystem\UserFeature\Interfaces\DataObject;

interface UserInterface
{
    public function getLogin(): string;

    public function isSubscribed(): ?bool;

    public function setSubscribed(?bool $subscribed): void;
}
