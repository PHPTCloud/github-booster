<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscribersFeature\Factory;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;

interface SubscriberFactoryInterface
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
    ): SubscriberInterface;
}
