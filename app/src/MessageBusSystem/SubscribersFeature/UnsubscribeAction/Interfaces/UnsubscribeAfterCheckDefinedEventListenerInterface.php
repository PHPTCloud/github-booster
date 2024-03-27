<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\UnsubscribeAfterCheckDefinedEventInterface;

/**
 * @deprecated
 */
interface UnsubscribeAfterCheckDefinedEventListenerInterface
{
    public function __invoke(UnsubscribeAfterCheckDefinedEventInterface $event): void;
}
