<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\UnsubscribeAction;

use App\ApplicationSystem\SubscribersFeature\Actions\CheckUnsubscribedHandledHookAction\Interfaces\UnsubscribeAfterCheckDefinedEventInterface;
use App\InfrastructureSystem\MessageBusFeatureApi\MessageBusInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeActionMessageFactoryInterface;
use App\MessageBusSystem\SubscribersFeature\UnsubscribeAction\Interfaces\UnsubscribeAfterCheckDefinedEventListenerInterface;

class UnsubscribeAfterCheckDefinedEventListener implements UnsubscribeAfterCheckDefinedEventListenerInterface
{
    public function __construct(
        private readonly UnsubscribeActionMessageFactoryInterface $messageFactory,
        private readonly MessageBusInterface $messageBus,
    ) {}

    public function __invoke(UnsubscribeAfterCheckDefinedEventInterface $event): void
    {
        foreach ($event->getUsers() as $user) {
            $this->messageBus->dispatch($this->messageFactory->create($user, $event->getTargetUserToken()));
        }
    }
}
