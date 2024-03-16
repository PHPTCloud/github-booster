<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SerializerFeature;

interface DeserializerInterface
{
    public const JSON_FORMAT = 'json';

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed;

    public function deserializeAsArray(mixed $data, string $type, string $format, array $context = []): mixed;
}
