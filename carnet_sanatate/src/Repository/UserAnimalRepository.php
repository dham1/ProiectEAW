<?php

namespace App\Repository;

use App\Entity\UserAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAnimal[]    findAll()
 * @method UserAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAnimal::class);
    }

    public function allAnimalsByUser($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.User = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return UserAnimal[] Returns an array of UserAnimal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAnimal
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
