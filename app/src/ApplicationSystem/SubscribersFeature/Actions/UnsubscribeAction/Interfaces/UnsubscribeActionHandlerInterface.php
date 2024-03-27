<?php
declare(strict_types=1);

namespace App\ApplicationSystem\SubscribersFeature\Actions\UnsubscribeAction\Interfaces;

use App\DomainSystem\UserFeature\Interfaces\DataObject\UserInterface;

/**
 * @deprecated
 */
interface UnsubscribeActionHandlerInterface
{
    public function handle(UserInterface $user, string $targetUserToken): void;
}
