<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;

interface SubscriptionManagerInterface
{
    public function saveSubscription(SubscriptionInterface $subscriber, bool $flush = false): void;
}
