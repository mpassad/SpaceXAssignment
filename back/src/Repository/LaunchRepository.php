<?php

namespace App\Repository;

use App\Entity\Launch;
use App\Entity\Rocket;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Launch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Launch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Launch[]    findAll()
 * @method Launch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LaunchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Launch::class);
    }

    public function findBetweenDates(DateTime $from = NULL, Datetime $to = NULL, string $order_by = 'ASC', Rocket $rocket = NULL): array
    {
        $query_builder = $this->createQueryBuilder('launch');
        $query = $query_builder;
        if ($from != NULL && $to != NULL) {
            $query = $query->where('launch.dateUtc BETWEEN :date_from AND :date_to')
                ->setParameter('date_from', $from->format('Y-m-d'))
                ->setParameter('date_to', $to->format('Y-m-d'));
        }
        if ($from == Null && $to != Null) {
            $query = $query->where('launch.dateUtc <= :date_to')
                ->setParameter('date_to', $to->format('Y-m-d'));
        }
        if ($from != Null && $to == Null) {
            $query = $query->where('launch.dateUtc >= :date_from')
                ->setParameter('date_from', $from->format('Y-m-d'));
        }
        if ($rocket != NULL) {
            $query = $query
                ->andWhere('launch.rocket = :rocket')
                ->setParameter('rocket', $rocket);
        }

        $query = $query
            ->orderBy('launch.dateUtc', $order_by)
            ->getQuery();
        return $query->getResult();
    }

    // /**
    //  * @return Launch[] Returns an array of Launch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Launch
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
