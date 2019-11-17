<?php

namespace App\Repository;

use App\Entity\HealthCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HealthCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method HealthCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method HealthCard[]    findAll()
 * @method HealthCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HealthCard::class);
    }

    // /**
    //  * @return HealthCard[] Returns an array of HealthCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HealthCard
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
