<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\LoggerFeature;

use Psr\Log\LoggerInterface as PSRLoggerInterface;

class Logger implements LoggerInterface
{
    private const PREFIX = '[GITHUB BOOSTER] ';

    public function __construct(
        private readonly PSRLoggerInterface $logger,
    ) {}

    public function debug(string $message, array $context): void
    {
        $this->logger->debug(self::PREFIX . $message, $context);
    }
}
