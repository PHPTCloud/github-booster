<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces;

interface SyncSubscribersActionCommandValidatorInterface
{
    public function validate(SyncSubscribersActionCommandInterface $command): ?array;
}
