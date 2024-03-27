<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

/**
 * @deprecated
 */
interface CheckUnsubscribedHandledHookActionCommandValidatorInterface
{
    public function validate(CheckUnsubscribedHandledHookActionCommandInterface $command): ?array;
}
