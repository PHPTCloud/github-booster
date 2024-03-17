<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\EventDispatcherFeature;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface as SymfonyEventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private readonly SymfonyEventDispatcherInterface $eventDispatcher,
    ) {}

    public function dispatch(EventInterface $event): bool
    {
        $this->eventDispatcher->dispatch($event);

        return true;
    }
}
