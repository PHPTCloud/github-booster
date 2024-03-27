<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction;

use App\ApplicationSystem\SubscriptionFeature\Interfaces\Manager\SubscriptionManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SyncSubscriptionsAction\Interfaces\SyncSubscriptionsActionHandlerInterface;

class Handler implements SyncSubscriptionsActionHandlerInterface
{
    public function __construct(
        private readonly SyncSubscriptionsActionCommandValidatorInterface $validator,
        private readonly SubscriptionManagerInterface $subscriptionManager,
    ) {}

    public function handle(SyncSubscriptionsActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscriptionManager->syncSubscriptions($command->getTargetUserToken(), $command->getTargetUsername());
    }
}
