<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscribersFeature\Storage;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;

interface SubscriberStorageInterface
{
    public function save(SubscriberInterface $subscriber, bool $flush = false): void;
}
