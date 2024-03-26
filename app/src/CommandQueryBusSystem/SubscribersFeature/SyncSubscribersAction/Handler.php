<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SyncSubscribersAction\Interfaces\SyncSubscribersActionHandlerInterface;

class Handler implements SyncSubscribersActionHandlerInterface
{
    public function __construct(
        private readonly SyncSubscribersActionCommandValidatorInterface $validator,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(SyncSubscribersActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscribersManager->syncSubscribers($command->getTargetUserToken(), $command->getTargetUsername());
    }
}
