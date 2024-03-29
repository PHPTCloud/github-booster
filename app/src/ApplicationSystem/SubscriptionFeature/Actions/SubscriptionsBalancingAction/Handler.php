<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction;

use App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionHandlerInterface;
use App\DomainSystem\SubscriptionFeature\Repository\SubscriptionRepositoryInterface;
use App\DomainSystem\SubscriptionFeature\Storage\SubscriptionStorageInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements SubscriptionsBalancingActionHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly SubscriptionStorageInterface $subscriptionStorage,
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): void
    {
        $subscriptions = $this->subscriptionRepository->findUnsubscribedByTargetUsername($targetUsername);

        $flush = false;
        $index = 0;
        $subscriptionsCount = count($subscriptions);

        foreach ($subscriptions as $subscription) {
            if ($index >= $subscriptionsCount - 1) {
                $flush = true;
            }

            try {
                $this->logger->debug('Вызов метода отписки от пользователя.', [
                    'subscription' => [
                        'targetUsername' => $subscription->getTargetUsername(),
                        'login' => $subscription->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                $this->internalSubscribersManager->unsubscribe($targetUserToken, $subscription->getLogin());
            } catch (\Throwable $throwable) {
                $this->logger->debug('Не удалось вызвать метод отписки.', [
                    'exception' => [
                        'message' => $throwable->getMessage(),
                        'class' => get_class($throwable),
                    ],
                    'subscription' => [
                        'targetUsername' => $subscription->getTargetUsername(),
                        'login' => $subscription->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);
                throw $throwable;
            }

            try {
                $this->logger->debug('Удаление записи о подписке из БД.', [
                    'subscription' => [
                        'targetUsername' => $subscription->getTargetUsername(),
                        'login' => $subscription->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                $this->subscriptionStorage->remove($subscription, $flush);
            } catch (\Throwable $throwable) {
                $this->logger->debug('Не удалось удалить подписку из БД.', [
                    'exception' => [
                        'message' => $throwable->getMessage(),
                        'class' => get_class($throwable),
                    ],
                    'subscription' => [
                        'targetUsername' => $subscription->getTargetUsername(),
                        'login' => $subscription->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);
                throw $throwable;
            }

            $index++;
        }
    }
}
