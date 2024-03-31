<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscribersFeature\Entity;

use App\DomainSystem\SubscribersFeature\Entity\SubscriberInterface;
use App\InfrastructureSystem\SubscribersFeature\Repository\SubscriberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'subscribers')]
#[ORM\Entity(repositoryClass: SubscriberRepository::class)]
class Subscriber implements SubscriberInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $targetUsername = null;

    #[ORM\Column]
    private ?string $login = null;

    #[ORM\Column(type: Types::BIGINT)]
    private int|float|null $internalId = null;

    #[ORM\Column]
    private ?string $url = null;

    #[ORM\Column]
    private ?string $repositoriesUrl = null;

    #[ORM\Column]
    private ?string $subscriptionsUrl = null;

    #[ORM\Column]
    private ?string $starredUrl = null;

    #[ORM\Column]
    private ?string $followersUrl = null;

    #[ORM\Column]
    private ?string $followingUrl = null;

    public function __construct(
        string $targetUsername,
        string $login,
        int|float $internalId,
        string $url,
        string $repositoriesUrl,
        string $subscriptionsUrl,
        string $starredUrl,
        string $followersUrl,
        string $followingUrl,
    ) {
        $this->targetUsername = $targetUsername;
        $this->login = $login;
        $this->internalId = $internalId;
        $this->url = $url;
        $this->repositoriesUrl = $repositoriesUrl;
        $this->subscriptionsUrl = $subscriptionsUrl;
        $this->starredUrl = $starredUrl;
        $this->followersUrl = $followersUrl;
        $this->followingUrl = $followingUrl;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTargetUsername(): string
    {
        return $this->targetUsername;
    }

    public function setTargetUsername(string $targetUsername): void
    {
        $this->targetUsername = $targetUsername;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getInternalId(): int|float
    {
        return $this->internalId;
    }

    public function setInternalId(int|float $internalId): void
    {
        $this->internalId = $internalId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getRepositoriesUrl(): string
    {
        return $this->repositoriesUrl;
    }

    public function setRepositoriesUrl(string $repositoriesUrl): void
    {
        $this->repositoriesUrl = $repositoriesUrl;
    }

    public function getSubscriptionsUrl(): string
    {
        return $this->subscriptionsUrl;
    }

    public function setSubscriptionsUrl(string $subscriptionsUrl): void
    {
        $this->subscriptionsUrl = $subscriptionsUrl;
    }

    public function getStarredUrl(): string
    {
        return $this->starredUrl;
    }

    public function setStarredUrl(string $starredUrl): void
    {
        $this->starredUrl = $starredUrl;
    }

    public function getFollowersUrl(): string
    {
        return $this->followersUrl;
    }

    public function setFollowersUrl(string $followersUrl): void
    {
        $this->followersUrl = $followersUrl;
    }

    public function getFollowingUrl(): string
    {
        return $this->followingUrl;
    }

    public function setFollowingUrl(string $followingUrl): void
    {
        $this->followingUrl = $followingUrl;
    }
}
