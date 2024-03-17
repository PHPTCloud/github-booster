<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces;

interface CheckUnsubscribedHandledHookActionCommandValidatorInterface
{
    public function validate(CheckUnsubscribedHandledHookActionCommandInterface $command): ?array;
}
