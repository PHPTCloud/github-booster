<?php
declare(strict_types=1);

namespace App\InfrastructureSystem\SubscriptionFeature\Repository;

use App\DomainSystem\SubscriptionFeature\Repository\SubscriptionRepositoryInterface;
use App\InfrastructureSystem\SubscribersFeature\Entity\Subscriber;
use App\InfrastructureSystem\SubscriptionFeature\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class SubscriptionRepository extends ServiceEntityRepository implements SubscriptionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    public function findUnsubscribedByTargetUsername(string $targetUsername): array
    {
        $queryBuilder = $this->createQueryBuilder('subscription');

        return $queryBuilder->leftJoin(
                Subscriber::class,
                'subscriber',
                Join::WITH,
                'subscription.login = subscriber.login',
            )
            ->andWhere('subscriber.login IS NULL')
            ->andWhere('subscription.targetUsername = :targetUsername')
            ->setParameter('targetUsername', $targetUsername)
            ->getQuery()
            ->getResult()
        ;
    }
}
