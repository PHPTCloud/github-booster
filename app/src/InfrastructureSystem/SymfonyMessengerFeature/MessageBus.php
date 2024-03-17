<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SymfonyMessengerFeature;

use Symfony\Component\Messenger\MessageBusInterface;

class MessageBus implements SymfonyMessageBusInterface
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {}

    public function dispatch(object $message, array $stamps = []): bool
    {
        $this->messageBus->dispatch($message, $stamps);

        return true;
    }
}
