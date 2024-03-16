<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionHandlerInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionQueryValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnfollowingAction\Interfaces\CheckUnfollowingActionResponseInterface;

class Handler implements CheckUnfollowingActionHandlerInterface
{
    public function __construct(
        private readonly CheckUnfollowingActionQueryValidatorInterface $validator,
        private readonly CheckUnfollowingActionResponseFactoryInterface $responseFactory,
        private readonly SubscribersManagerInterface $subscribersManager,
    ) {}

    public function handle(CheckUnfollowingActionQueryInterface $query): CheckUnfollowingActionResponseInterface
    {
        $errors = $this->validator->validate($query);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $unfollowingUsers = $this->subscribersManager->checkUnfollowing(
            $query->getTargetUserToken(),
            $query->getTargetUsername(),
        );

        return $this->responseFactory->create($unfollowingUsers);
    }
}
