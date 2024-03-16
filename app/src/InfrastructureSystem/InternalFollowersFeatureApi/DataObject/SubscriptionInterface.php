<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject;

interface SubscriptionInterface
{
    public function getLogin(): string;

    public function getId(): int|float;
}
