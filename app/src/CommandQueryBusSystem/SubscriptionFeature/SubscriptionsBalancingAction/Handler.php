<?php
declare(strict_types=1);

namespace App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction;

use App\ApplicationSystem\SubscriptionFeature\Interfaces\Manager\SubscriptionManagerInterface;
use App\CommandQueryBusSystem\Exception\CommandQueryValidatorException;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionCommandValidatorInterface;
use App\CommandQueryBusSystem\SubscriptionFeature\SubscriptionsBalancingAction\Interfaces\SubscriptionsBalancingActionHandlerInterface;

class Handler implements SubscriptionsBalancingActionHandlerInterface
{
    public function __construct(
        private readonly SubscriptionsBalancingActionCommandValidatorInterface $validator,
        private readonly SubscriptionManagerInterface $subscriptionManager,
    ) {}

    public function handle(SubscriptionsBalancingActionCommandInterface $command): void
    {
        $errors = $this->validator->validate($command);
        if ($errors) {
            throw new CommandQueryValidatorException($errors);
        }

        $this->subscriptionManager->subscriptionsBalancing($command->getTargetUserToken(), $command->getTargetUsername());
    }
}
