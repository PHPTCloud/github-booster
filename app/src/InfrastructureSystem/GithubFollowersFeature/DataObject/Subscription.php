<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\GithubFollowersFeature\DataObject;

use App\InfrastructureSystem\InternalFollowersFeatureApi\DataObject\SubscriptionInterface;

class Subscription implements SubscriptionInterface
{
    public function __construct(
        private readonly string $login,
        private readonly int $id,
        private readonly string $url,
        private readonly string $repos_url,
        private readonly string $subscriptions_url,
        private readonly string $starred_url,
        private readonly string $followers_url,
        private readonly string $following_url,
    ) {}

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getReposUrl(): string
    {
        return $this->repos_url;
    }

    public function getSubscriptionsUrl(): string
    {
        return $this->subscriptions_url;
    }

    public function getStarredUrl(): string
    {
        return $this->starred_url;
    }

    public function getFollowersUrl(): string
    {
        return $this->followers_url;
    }

    public function getFollowingUrl(): string
    {
        return $this->following_url;
    }
}
