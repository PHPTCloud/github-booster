<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\DoctrineFeature;

use App\InfrastructureSystem\LoggerFeature\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineEntityManager implements DoctrineEntityManagerInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function save(object $entity, bool $flush = false): void
    {
        $this->entityManager->persist($entity);
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    public function removeBy(string $table, array $criteria): void
    {
        $queryString = sprintf('DELETE FROM %s entity', $table);

        $wherePart = [];
        foreach ($criteria as $attribute => $value) {
            $wherePart[] = sprintf('entity.%s = :%s', $attribute, $attribute);
        }

        if (!empty($wherePart)) {
            $queryString .= ' WHERE ' . implode(' AND ', $wherePart);
        }

        $query = $this->entityManager->createQuery($queryString);
        $response = $query->execute($criteria);

        $this->logger->debug(sprintf('Удалено %s записей', $response), [
            'arguments' => func_get_args(),
            'class' => __CLASS__,
            'method' => __METHOD__,
            'line' => __LINE__,
        ]);
    }
}
