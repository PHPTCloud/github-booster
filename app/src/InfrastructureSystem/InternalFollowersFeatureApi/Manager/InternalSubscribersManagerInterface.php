<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\InternalFollowersFeatureApi\Manager;

use App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject\SubscriptionInterface;

interface InternalSubscribersManagerInterface
{
    /**
     * @return SubscriptionInterface[]
     */
    public function getSubscriptions(string $token, int $page = 1, int $limit = 30): array;

    public function subscriptionCheck(string $token, string $targetUsername, string $username): bool;
}
