<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

/**
 * @deprecated
 */
interface UnsubscribeActionHandlerInterface
{
    public function handle(UnsubscribeActionCommandInterface $command): void;
}
