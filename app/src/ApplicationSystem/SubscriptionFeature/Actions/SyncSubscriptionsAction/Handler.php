<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\SyncSubscriptionsAction;

use App\ApplicationSystem\SubscriptionFeature\Actions\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;
use App\DomainSystem\SubscriptionFeature\Factory\SubscriptionFactoryInterface;
use App\DomainSystem\SubscriptionFeature\SubscriptionManagerInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Exception\OutOfRangeException;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements SyncSubscriptionsActionHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
        private readonly SubscriptionManagerInterface $subscriptionManager,
        private readonly SubscriptionFactoryInterface $subscriptionFactory,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): void
    {
        $page = 1;
        $limit = 500;

        /**
         * Используем true, так как когда дойдем до конца списка
         * выйдем из цикла через исключение OutOfRangeException.
         */
        while (true) {
            try {
                $subscriptions = $this->internalSubscribersManager->getSubscriptions($targetUserToken, $page, $limit);
            } catch (OutOfRangeException $exception) {
                $this->logger->debug($exception->getMessage(), [
                    'username' => $targetUsername,
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                return;
            }

            $count = count($subscriptions);
            $flush = false;
            $index = 0;

            foreach ($subscriptions as $subscription) {
                if ($index >= ($count - 1)) {
                    $flush = true;
                }

                $entity = $this->subscriptionFactory->create(
                    targetUsername: $targetUsername,
                    login: $subscription->getLogin(),
                    internalId: $subscription->getId(),
                    url: $subscription->getUrl(),
                    repositoriesUrl: $subscription->getReposUrl(),
                    subscriptionsUrl: $subscription->getSubscriptionsUrl(),
                    starredUrl: $subscription->getStarredUrl(),
                    followersUrl: $subscription->getFollowersUrl(),
                    followingUrl: $subscription->getFollowingUrl(),
                );
                $this->subscriptionManager->saveSubscription($entity, $flush);

                $index++;
            }

            $page++;
        }
    }
}
