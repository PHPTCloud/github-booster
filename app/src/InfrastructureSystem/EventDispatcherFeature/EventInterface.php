<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\EventDispatcherFeature;

interface EventInterface
{
    public function getName(): string;
}
