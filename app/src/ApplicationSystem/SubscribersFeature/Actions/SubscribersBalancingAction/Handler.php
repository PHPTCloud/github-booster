<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\SubscribersBalancingAction;

use App\ApplicationSystem\SubscribersFeature\Actions\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionHandlerInterface;
use App\DomainSystem\SubscribersFeature\Repository\SubscriberRepositoryInterface;
use App\InfrastructureSystem\InternalFollowersFeatureApi\Manager\InternalSubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;

class Handler implements SubscribersBalancingActionHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly InternalSubscribersManagerInterface $internalSubscribersManager,
        private readonly SubscriberRepositoryInterface $subscriberRepository,
    ) {}

    public function handle(string $targetUserToken, string $targetUsername): void
    {
        $subscribers = $this->subscriberRepository->findSubscribedByTargetUsername($targetUsername);

        foreach ($subscribers as $subscriber) {
            try {
                $this->logger->debug('Вызов метода подписки на пользователя.', [
                    'subscription' => [
                        'targetUsername' => $subscriber->getTargetUsername(),
                        'login' => $subscriber->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                $this->internalSubscribersManager->subscribe($targetUserToken, $subscriber->getLogin());
            } catch (\Throwable $throwable) {
                $this->logger->debug('Не удалось вызвать метод подписки.', [
                    'exception' => [
                        'message' => $throwable->getMessage(),
                        'class' => get_class($throwable),
                    ],
                    'subscription' => [
                        'targetUsername' => $subscriber->getTargetUsername(),
                        'login' => $subscriber->getLogin(),
                    ],
                    'class' => __CLASS__,
                    'method' => __METHOD__,
                    'line' => __LINE__,
                ]);

                if ($throwable->getCode() === 404) {
                    continue;
                }

                throw $throwable;
            }
        }
    }
}
