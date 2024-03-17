<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction;

use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionHandlerInterface;
use App\InfrastructureSystem\LoggerFeature\LoggerInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageHandlerInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageInterface;

class MessageHandler implements UnsubscribeActionMessageHandlerInterface
{
    public function __construct(
        private readonly UnsubscribeActionCommandFactoryInterface $commandFactory,
        private readonly UnsubscribeActionHandlerInterface $handler,
        private readonly LoggerInterface $logger,
    ) {}

    public function __invoke(UnsubscribeActionMessageInterface $message): void
    {
        $this->handler->handle($this->commandFactory->create($message->getUser(), $message->getTargetUserToken()));

        $this->logger->debug(sprintf('Отписались от пользователя %s', $message->getUser()->getLogin()), [
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
