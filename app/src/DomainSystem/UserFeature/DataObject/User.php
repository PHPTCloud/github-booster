<?php
declare(strict_types=1);

namespace App\DomainSystem\UserFeature\DataObject;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
class User implements UserInterface
{
    public function __construct(
        private readonly string $login,
        private ?bool $subscribed = null,
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function isSubscribed(): ?bool
    {
        return $this->subscribed;
    }

    public function setSubscribed(?bool $subscribed): void
    {
        $this->subscribed = $subscribed;
    }
}
