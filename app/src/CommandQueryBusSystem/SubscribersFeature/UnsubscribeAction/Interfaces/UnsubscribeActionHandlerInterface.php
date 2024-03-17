<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

interface UnsubscribeActionHandlerInterface
{
    public function handle(UnsubscribeActionCommandInterface $command): void;
}
