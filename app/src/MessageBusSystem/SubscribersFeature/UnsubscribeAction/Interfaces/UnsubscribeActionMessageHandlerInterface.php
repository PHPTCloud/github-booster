<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

/**
 * @deprecated
 */
interface UnsubscribeActionMessageHandlerInterface
{
    public function __invoke(UnsubscribeActionMessageInterface $message): void;
}
