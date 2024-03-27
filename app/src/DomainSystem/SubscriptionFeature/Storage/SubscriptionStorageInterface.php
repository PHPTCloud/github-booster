<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature\Storage;

use App\DomainSystem\SubscriptionFeature\Entity\SubscriptionInterface;

interface SubscriptionStorageInterface
{
    public function save(SubscriptionInterface $subscription, bool $flush = false): void;

    public function removeByTargetUsername(string $targetUsername): void;
}
