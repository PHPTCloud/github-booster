<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedAction;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandlerInterface;
use App\DomainSystem\UserFeature\Interfaces\Factory\UserFactoryInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements CheckUnsubscribedActionHandlerInterface
{
    public function __construct(
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
        private readonly UserFactoryInterface $userFactory,
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername, int $page = 1, int $limit = 100): array
    {
        $subscriptions = $this->internalSubscribersManager->getSubscriptions($targetUserToken, $page, $limit);

        $unfollowingUsers = [];

        $this->logger->debug('Получили список подписчиков.', [
            'page' => $page,
            'limit' => $limit,
            'count' => count($subscriptions),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        foreach ($subscriptions as $subscription) {
            $isSubscribed = $this->internalSubscribersManager->subscriptionCheck(
                $targetUserToken,
                $targetUsername,
                $subscription->getLogin(),
            );

            if (!$isSubscribed) {
                $user = $this->userFactory->create($subscription->getLogin(), false);
                $unfollowingUsers[] = $user;

                $this->logger->debug('Найден не подписанный пользователь.', [
                    'username' => $user->getLogin(),
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);
            }

            $this->logger->debug(sprintf('Проверили подписан ли пользователь на "%s".', $targetUsername), [
                'username' => $subscription->getLogin(),
                'class' => __CLASS__,
                'method' => __METHOD__,
                'line' => __LINE__,
            ]);
        }

        return $unfollowingUsers;
    }
}
