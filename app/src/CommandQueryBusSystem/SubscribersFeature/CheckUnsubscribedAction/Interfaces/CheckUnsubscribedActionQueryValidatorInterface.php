<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces;

interface CheckUnsubscribedActionQueryValidatorInterface
{
    public function validate(CheckUnsubscribedActionQueryInterface $query): ?array;
}
