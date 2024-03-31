<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscribersFeature\Repository;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;

interface SubscriberRepositoryInterface
{
    /**
     * @param string $targetUsername
     *
     * @return SubscriberInterface[]
     */
    public function findSubscribedByTargetUsername(string $targetUsername): array;
}
