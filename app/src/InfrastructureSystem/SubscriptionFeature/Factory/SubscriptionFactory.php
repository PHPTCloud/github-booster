<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscriptionFeature\Factory;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;
use App\DomainSystem\SubscriptionFeature\Factory\SubscriptionFactoryInterface;
use App\InfrastructureSystem\SubscriptionFeature\Entity\Subscription;

class SubscriptionFactory implements SubscriptionFactoryInterface
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
    ): SubscriptionInterface {
        return new Subscription(
            $targetUsername,
            $login,
            $internalId,
            $url,
            $repositoriesUrl,
            $subscriptionsUrl,
            $starredUrl,
            $followersUrl,
            $followingUrl,
        );
    }
}
