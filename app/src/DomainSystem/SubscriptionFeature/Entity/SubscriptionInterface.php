<?php
declare(strict_types=1);

namespace App\DomainSystem\SubscriptionFeature\Entity;

interface SubscriptionInterface
{
    public function getId(): ?int;

    public function getTargetUsername(): string;

    public function setTargetUsername(string $targetUsername): void;

    public function getLogin(): string;

    public function setLogin(string $login): void;

    public function getInternalId(): int|float;

    public function setInternalId(int|float $internalId): void;

    public function getUrl(): string;

    public function setUrl(string $url): void;

    public function getRepositoriesUrl(): string;

    public function setRepositoriesUrl(string $repositoriesUrl): void;

    public function getSubscriptionsUrl(): string;

    public function setSubscriptionsUrl(string $subscriptionsUrl): void;

    public function getStarredUrl(): string;

    public function setStarredUrl(string $starredUrl): void;

    public function getFollowersUrl(): string;

    public function setFollowersUrl(string $followersUrl): void;

    public function getFollowingUrl(): string;

    public function setFollowingUrl(string $followingUrl): void;
}
