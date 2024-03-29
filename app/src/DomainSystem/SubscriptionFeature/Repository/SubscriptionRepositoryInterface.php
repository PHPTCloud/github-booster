<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature\Repository;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;

interface SubscriptionRepositoryInterface
{
    /**
     * @param string $targetUsername
     *
     * @return SubscriptionInterface[]
     */
    public function findUnsubscribedByTargetUsername(string $targetUsername): array;
}
