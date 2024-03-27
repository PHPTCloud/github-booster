<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscriptionFeature\Storage;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;
use App\DomainSystem\SubscriptionFeature\Storage\SubscriptionStorageInterface;
use App\InfrastructureSystem\DatabaseFeatureApi\DatabaseEntityManagerInterface;
use App\InfrastructureSystem\SubscriptionFeature\Entity\Subscription;

class SubscriptionStorage implements SubscriptionStorageInterface
{
    public function __construct(
        private readonly DatabaseEntityManagerInterface $entityManager,
    ) {}

    public function save(SubscriptionInterface $subscription, bool $flush = false): void
    {
        $this->entityManager->save($subscription, $flush);
    }

    public function removeByTargetUsername(string $targetUsername): void
    {
        $this->entityManager->removeBy(Subscription::class, [
            'targetUsername' => $targetUsername,
        ]);
    }
}
