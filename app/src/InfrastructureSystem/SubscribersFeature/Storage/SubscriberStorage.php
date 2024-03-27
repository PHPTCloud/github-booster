<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscribersFeature\Storage;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;
use App\DomainSystem\SubscribersFeature\Storage\SubscriberStorageInterface;
use App\InfrastructureSystem\DatabaseFeatureApi\DatabaseEntityManagerInterface;
use App\InfrastructureSystem\SubscribersFeature\Entity\Subscriber;

class SubscriberStorage implements SubscriberStorageInterface
{
    public function __construct(
        private readonly DatabaseEntityManagerInterface $entityManager,
    ) {}

    public function save(SubscriberInterface $subscriber, bool $flush = false): void
    {
        $this->entityManager->save($subscriber, $flush);
    }

    public function removeBy(array $criteria): void
    {
        $this->entityManager->removeBy(Subscriber::class, $criteria);
    }
}
