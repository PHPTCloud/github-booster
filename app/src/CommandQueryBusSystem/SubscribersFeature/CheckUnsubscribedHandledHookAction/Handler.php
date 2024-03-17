<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionHandlerInterface;

class Handler implements CheckUnsubscribedHandledHookActionHandlerInterface
{
    public function __construct(
        private readonly CheckUnsubscribedHandledHookActionCommandValidatorInterface $validator,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(CheckUnsubscribedHandledHookActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscribersManager->handleCheckUnsubscribedHandledHook(
            $command->getResponse()->getItems(),
            $command->getTargetUserToken(),
            $command->getTargetUsername(),
            $command->getActions(),
        );
    }
}
