<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscriptionFeature\Actions\RemoveAllSubscriptionsAction\Interfaces;

interface RemoveAllSubscriptionsHandlerInterface
{
    public function handle(string $targetUserName): void;
}
