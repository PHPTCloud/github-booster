<?php
declare(strict_types=1);

namespace App\DomainSystem\UserFeature\Interfaces\Factory;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

interface UserFactoryInterface
{
    public function create(string $login, ?bool $subscribed = null): UserInterface;
}
