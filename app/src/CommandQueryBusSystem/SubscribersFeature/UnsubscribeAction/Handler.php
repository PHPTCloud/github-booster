<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandInterface;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionHandlerInterface;

class Handler implements UnsubscribeActionHandlerInterface
{
    public function __construct(
        private readonly UnsubscribeActionCommandValidatorInterface $validator,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(UnsubscribeActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if (!empty($errors)) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscribersManager->unsubscribe($command->getUser(), $command->getTargetUserToken());
    }
}
