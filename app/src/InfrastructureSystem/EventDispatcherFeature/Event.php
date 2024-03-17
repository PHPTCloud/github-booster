<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\EventDispatcherFeature;

use Symfony\Contracts\EventDispatcher\Event as SymfonyEvent;

class Event extends SymfonyEvent implements EventInterface
{
    public function getName(): string
    {
        return self::class;
    }
}
