<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\RemoveAllSubscribersAction;

use App\ApplicationSystem\SubscribersFeature\Actions\RemoveAllSubscribersAction\Interfaces\RemoveAllSubscribersHandlerInterface;
use App\DomainSystem\SubscribersFeature\SubscribersManagerInterface;

class Handler implements RemoveAllSubscribersHandlerInterface
{
    public function __construct(
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(string $targetUsername): void
    {
        $this->subscribersManager->removeByTargetUsername($targetUsername);
    }
}
