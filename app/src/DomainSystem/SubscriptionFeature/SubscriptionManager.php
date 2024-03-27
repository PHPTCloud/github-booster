<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;
use App\DomainSystem\SubscriptionFeature\Storage\SubscriptionStorageInterface;

class SubscriptionManager implements SubscriptionManagerInterface
{
    public function __construct(
        private readonly SubscriptionStorageInterface $subscriptionStorage,
    ) {}

    public function saveSubscription(SubscriptionInterface $subscriber, bool $flush = false): void
    {
        $this->subscriptionStorage->save($subscriber, $flush);
    }
}
