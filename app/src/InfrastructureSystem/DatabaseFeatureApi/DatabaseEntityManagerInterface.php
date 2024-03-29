<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\DatabaseFeatureApi;

interface DatabaseEntityManagerInterface
{
    public function save(object $entity, bool $flush = false): void;

    public function removeBy(string $table, array $criteria): void;

    public function remove(object $entity, bool $flush = false): void;
}
