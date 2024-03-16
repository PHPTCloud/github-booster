<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\GithubFollowersFeature\DataObject;

use App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject\SubscriptionInterface;

class Subscription implements SubscriptionInterface
{
    public function __construct(
        private readonly string $login,
        private readonly int $id,
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
