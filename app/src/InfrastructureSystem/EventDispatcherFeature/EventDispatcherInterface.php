<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\EventDispatcherFeature;

interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): bool;
}
