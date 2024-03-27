<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces;

/**
 * @deprecated
 */
interface UnsubscribeActionCommandValidatorInterface
{
    public function validate(UnsubscribeActionCommandInterface $command): ?array;
}
