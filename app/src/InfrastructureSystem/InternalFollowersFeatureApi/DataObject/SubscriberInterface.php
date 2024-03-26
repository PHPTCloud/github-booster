<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject;

interface SubscriberInterface
{
    public function getLogin(): string;

    public function getId(): int|float;

    public function getUrl(): string;

    public function getReposUrl(): string;

    public function getSubscriptionsUrl(): string;

    public function getStarredUrl(): string;

    public function getFollowersUrl(): string;

    public function getFollowingUrl(): string;
}
