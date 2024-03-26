<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscribersFeature;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;

interface SubscribersManagerInterface
{
    public function saveSubscriber(SubscriberInterface $subscriber, bool $flush = false): void;
}
