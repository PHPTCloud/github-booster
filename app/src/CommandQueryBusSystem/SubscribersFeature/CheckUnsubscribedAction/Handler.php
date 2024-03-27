<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction;

use App\ApplicationSystem\SubscribersFeature\Interfaces\Manager\SubscribersManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandlerInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionQueryValidatorInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseFactoryInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionResponseInterface;
use App\InfrastructureSystem\EventDispatcherFeature\EventDispatcherInterface;

/**
 * @deprecated
 */
class Handler implements CheckUnsubscribedActionHandlerInterface
{
    public function __construct(
        private readonly CheckUnsubscribedActionQueryValidatorInterface $validator,
        private readonly CheckUnsubscribedActionResponseFactoryInterface $responseFactory,
        private readonly SubscribersManagerInterface $subscribersManager,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {}

    public function handle(CheckUnsubscribedActionQueryInterface $query): CheckUnsubscribedActionResponseInterface
    {
        $errors = $this->validator->validate($query);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $unfollowingUsers = $this->subscribersManager->checkUnsubscribed(
            $query->getTargetUserToken(),
            $query->getTargetUsername(),
            $query->getPage(),
            $query->getLimit(),
        );

        $response = $this->responseFactory->create($unfollowingUsers);

        $this->eventDispatcher->dispatch(new HandledEvent(
            $response,
            $query->getTargetUserToken(),
            $query->getTargetUsername(),
            $query->getActions(),
        ));

        return $response;
    }
}
