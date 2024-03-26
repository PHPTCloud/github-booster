<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscribersAction;

use App\ApplicationSystem\SubscribersFeature\Actions\SyncSubscribersAction\Interfaces\SyncSubscribersActionHandlerInterface;
use App\DomainSystem\SubscribersFeature\Factory\SubscriberFactoryInterface;
use App\DomainSystem\SubscribersFeature\SubscribersManagerInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Exception\OutOfRangeException;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements SyncSubscribersActionHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
        private readonly SubscribersManagerInterface $subscribersManager,
        private readonly SubscriberFactoryInterface $subscriberFactory,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): void
    {
        $page = 1;
        $limit = 500;

        // Используем true, так как когда дойдем до конца списка выйдем из цикла через исклюение OutOfRangeException.
        while (true) {
            try {
                $subscribers = $this->internalSubscribersManager->getSubscriptions($targetUserToken, $page, $limit);
            } catch (OutOfRangeException $exception) {
                $this->logger->debug($exception->getMessage(), [
                    'username' => $targetUsername,
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                return;
            }

            $count = count($subscribers);
            $flush = false;
            $index = 0;

            foreach ($subscribers as $subscriber) {
                if ($index >= ($count - 1)) {
                    $flush = true;
                }

                $entity = $this->subscriberFactory->create(
                    targetUsername: $targetUsername,
                    login: $subscriber->getLogin(),
                    internalId: $subscriber->getId(),
                    url: $subscriber->getUrl(),
                    repositoriesUrl: $subscriber->getReposUrl(),
                    subscriptionsUrl: $subscriber->getSubscriptionsUrl(),
                    starredUrl: $subscriber->getStarredUrl(),
                    followersUrl: $subscriber->getFollowersUrl(),
                    followingUrl: $subscriber->getFollowingUrl(),
                );
                $this->subscribersManager->saveSubscriber($entity, $flush);

                $index++;
            }

            $page++;
        }
    }
}
