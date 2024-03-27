<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces;

interface SyncSubscriptionsActionCommandValidatorInterface
{
    public function validate(SyncSubscriptionsActionCommandInterface $command): ?array;
}
