<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\MessageBusFeatureApi;

interface MessageBusInterface
{
    public function dispatch(object $message, array $stamps = []): bool;
}
