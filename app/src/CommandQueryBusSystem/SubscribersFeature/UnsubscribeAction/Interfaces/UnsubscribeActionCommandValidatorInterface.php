<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

interface UnsubscribeActionCommandValidatorInterface
{
    public function validate(UnsubscribeActionCommandInterface $command): ?array;
}
