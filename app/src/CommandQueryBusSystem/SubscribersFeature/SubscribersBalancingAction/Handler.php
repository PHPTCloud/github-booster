<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\SubscribersBalancingAction\Interfaces\SubscribersBalancingActionHandlerInterface;

class Handler implements SubscribersBalancingActionHandlerInterface
{
    public function __construct(
        private readonly SubscribersBalancingActionCommandValidatorInterface $validator,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(SubscribersBalancingActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscribersManager->subscribersBalancing($command->getTargetUserToken(), $command->getTargetUsername());
    }
}
