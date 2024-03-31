<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscribersFeature\Repository;

use App\DomainSystem\SubscribersFeature\Repository\SubscriberRepositoryInterface;
use App\InfrastructureSystem\SubscribersFeature\Entity\Subscriber;
use App\InfrastructureSystem\SubscriptionFeature\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class SubscriberRepository extends ServiceEntityRepository implements SubscriberRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscriber::class);
    }

    public function findSubscribedByTargetUsername(string $targetUsername): array
    {
        $queryBuilder = $this->createQueryBuilder('subscriber');

        return $queryBuilder->leftJoin(
                Subscription::class,
                'subscription',
                Join::WITH,
                'subscription.login = subscriber.login',
            )
            ->andWhere('subscription.login IS NULL')
            ->andWhere('subscriber.targetUsername = :targetUsername')
            ->setParameter('targetUsername', $targetUsername)
            ->getQuery()
            ->getResult()
            ;
    }
}
