<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\CheckUnfollowingAction;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionHandlerInterface;
use App\DomainSystem\UserFeature\Interfaces\Factory\UserFactoryInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements CheckUnfollowingActionHandlerInterface
{
    public function __construct(
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
        private readonly UserFactoryInterface $userFactory,
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): array
    {
        $page = 1;
        $limit = 100;

        $subscriptions = $this->internalSubscribersManager->getSubscriptions($targetUserToken, $page, $limit);

        $unfollowingUsers = [];

        while (!empty($subscriptions)) {
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
                    $unfollowingUsers[] = $this->userFactory->create($subscription->getLogin(), false);
                }

                $this->logger->debug(sprintf('Проверили подписан ли пользователь на "%s".', $targetUsername), [
                    'username' => $subscription->getLogin(),
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);
            }

            usleep(200000);

            $this->logger->debug('Итерация завершена.', [
                'class' => __CLASS__,
                'method' => __METHOD__,
                'line' => __LINE__,
            ]);

            $page += 1;
            $subscriptions = $this->internalSubscribersManager->getSubscriptions($targetUserToken, $page, $limit);
        }

        return $unfollowingUsers;
    }
}
