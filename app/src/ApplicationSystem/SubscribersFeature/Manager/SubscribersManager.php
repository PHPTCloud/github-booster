<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Manager;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionHandlerInterface;
use App\ApplicationSystem\SubscribersFeature\Interfaces\SubscribersManagerInterface;

class SubscribersManager implements SubscribersManagerInterface
{
    public function __construct(
        private readonly CheckUnfollowingActionHandlerInterface $checkUnfollowingActionHandler,
    ) {}

    public function checkUnfollowing(string $targetUserToken, string $targetUsername): array
    {
        return $this->checkUnfollowingActionHandler->handle($targetUserToken, $targetUsername);
    }
}
