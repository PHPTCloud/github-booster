<?php
declare(strict_types=1);

namespace App\DomainSystem\UserFeature\Factory;

use App\DomainSystem\UserFeature\DataObject\User;
use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;
use App\DomainSystem\UserFeature\Interfaces\Factory\UserFactoryInterface;

/**
 * @deprecated
 */
class UserFactory implements UserFactoryInterface
{
    public function create(string $login, ?bool $subscribed = null): UserInterface
    {
        return new User($login, $subscribed);
    }
}
