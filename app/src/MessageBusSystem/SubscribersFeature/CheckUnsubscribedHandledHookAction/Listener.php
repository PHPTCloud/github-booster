<?php
declare(strict_types=1);

namespace App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction;

use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedAction\Interfaces\CheckUnsubscribedActionHandledEventInterface;
use App\CommandQueryBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionCommandFactoryInterface;
use App\InfrastructureSystem\MessageBusFeatureApi\MessageBusInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionListenerInterface;
use App\MessageBusSystem\SubscribersFeature\CheckUnsubscribedHandledHookAction\Interfaces\CheckUnsubscribedHandledHookActionMessageFactoryInterface;

/**
 * Не нужно использовать AsEventListener. Настройку слушателя делаем через services.yaml.
 */
class Listener implements CheckUnsubscribedHandledHookActionListenerInterface
{
    public function __construct(
        private readonly CheckUnsubscribedHandledHookActionCommandFactoryInterface $commandFactory,
        private readonly CheckUnsubscribedHandledHookActionMessageFactoryInterface $messageFactory,
        private readonly MessageBusInterface $messageBus,
    ) {}

    public function __invoke(CheckUnsubscribedActionHandledEventInterface $event): void
    {
        if (empty($event->getResponse()->getItems())) {
            return;
        }

        $this->messageBus->dispatch(
            $this->messageFactory->create(
                $this->commandFactory->create(
                    $event->getResponse(),
                    $event->getTargetUserToken(),
                    $event->getTargetUsername(),
                    $event->getActions(),
                ),
            ),
        );
    }
}
