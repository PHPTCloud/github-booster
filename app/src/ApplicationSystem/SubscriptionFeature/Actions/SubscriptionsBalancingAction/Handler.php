<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction;

use App\ApplicationSystem\SubscriptionFeature\Actions\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionHandlerInterface;
use App\DomainSystem\SubscriptionFeature\Repository\SubscriptionRepositoryInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements SubscriptionsBalancingActionHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): void
    {
        $subscriptions = $this->subscriptionRepository->findUnsubscribedByTargetUsername($targetUsername);

        foreach ($subscriptions as $subscription) {
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
        }
    }
}
