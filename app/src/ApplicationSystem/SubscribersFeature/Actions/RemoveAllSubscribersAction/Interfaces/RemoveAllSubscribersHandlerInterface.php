<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\RemoveAllSubscribersAction\Interfaces;

interface RemoveAllSubscribersHandlerInterface
{
    public function handle(string $targetUsername): void;
}
