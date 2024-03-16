<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SerializerFeature;

use Symfony\Component\Serializer\SerializerInterface;

class Deserializer implements DeserializerInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    ) {}

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    public function deserializeAsArray(mixed $data, string $type, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $type . '[]', $format, $context);
    }
}
