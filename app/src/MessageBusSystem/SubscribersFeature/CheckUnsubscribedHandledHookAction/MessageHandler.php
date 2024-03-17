<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionHandlerInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageHandlerInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageInterface;

class MessageHandler implements CheckUnsubscribedHandledHookActionMessageHandlerInterface
{
    public function __construct(
        private readonly CheckUnsubscribedHandledHookActionHandlerInterface $handler,
    ) {}

    public function __invoke(CheckUnsubscribedHandledHookActionMessageInterface $message): void
    {
        $this->handler->handle($message->getCommand());
    }
}
