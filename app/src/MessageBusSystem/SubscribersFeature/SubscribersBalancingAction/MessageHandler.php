<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\CommandQueryBusSystem\SubscribersFeature\SubscribersManagerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;
use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageHandlerInterface;
use App\MessageBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionMessageInterface;

/**
 * Хендлеры конфигурируются через services.yaml, чтобы отвязаться от компонента Symfony/Messenger.
 */
class MessageHandler implements SubscribersBalancingActionMessageHandlerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function __invoke(SubscribersBalancingActionMessageInterface $message): void
    {
        $this->logger->debug(sprintf('%s method started', __METHOD__), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);

        $this->subscribersManager->subscribersBalancing($message->getTargetUserToken(), $message->getTargetUsername());

        $this->logger->debug(sprintf('%s method ended', __METHOD__), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
