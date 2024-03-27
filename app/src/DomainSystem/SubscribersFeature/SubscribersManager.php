<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscribersFeature;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;
use App\DomainSystem\SubscribersFeature\Storage\SubscriberStorageInterface;

class SubscribersManager implements SubscribersManagerInterface
{
    public function __construct(
        private readonly SubscriberStorageInterface $subscriberStorage,
    ) {}

    public function saveSubscriber(SubscriberInterface $subscriber, bool $flush = false): void
    {
        $this->subscriberStorage->save($subscriber, $flush);
    }

    public function removeByTargetUsername(string $targetUsername): void
    {
        $this->subscriberStorage->removeBy(['targetUsername' => $targetUsername]);
    }
}
