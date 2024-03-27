<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature\Factory;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;

interface SubscriptionFactoryInterface
{
    public function create(
        string $targetUsername,
        string $login,
        int|float $internalId,
        string $url,
        string $repositoriesUrl,
        string $subscriptionsUrl,
        string $starredUrl,
        string $followersUrl,
        string $followingUrl,
    ): SubscriptionInterface;
}
