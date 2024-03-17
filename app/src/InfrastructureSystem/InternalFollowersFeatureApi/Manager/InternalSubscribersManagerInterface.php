<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\InternalFollowersFeatureApi\Manager;

use App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject\SubscriptionInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Exception\OutOfRangeException;

interface InternalSubscribersManagerInterface
{
    /**
     * @return SubscriptionInterface[]
     * @throws OutOfRangeException - получим исключение, если метод вернет пустой массив.
     */
    public function getSubscriptions(string $token, int $page = 1, int $limit = 30): array;

    public function subscriptionCheck(string $token, string $targetUsername, string $username): bool;

    public function unsubscribe(string $token, string $username): bool;
}
