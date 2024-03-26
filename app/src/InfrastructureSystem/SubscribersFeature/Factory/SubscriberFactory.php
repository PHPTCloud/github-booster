<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscribersFeature\Factory;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;
use App\DomainSystem\SubscribersFeature\Factory\SubscriberFactoryInterface;
use App\InfrastructureSystem\SubscribersFeature\Entity\Subscriber;

class SubscriberFactory implements SubscriberFactoryInterface
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
    ): SubscriberInterface {
        return new Subscriber(
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
