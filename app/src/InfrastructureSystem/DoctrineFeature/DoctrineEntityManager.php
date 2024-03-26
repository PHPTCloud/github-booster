<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\DoctrineFeature;

use Doctrine\ORM\EntityManagerInterface;

class DoctrineEntityManager implements DoctrineEntityManagerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function save(object $entity, bool $flush = false): void
    {
        $this->entityManager->persist($entity);
        if ($flush) {
            $this->entityManager->flush();
        }
    }
}
