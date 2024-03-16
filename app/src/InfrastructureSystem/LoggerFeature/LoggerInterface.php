<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\LoggerFeature;

interface LoggerInterface
{
    public function debug(string $message, array $context): void;
}
