<?php

namespace App\Repository;

use App\Entity\Epidsode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Epidsode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Epidsode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Epidsode[]    findAll()
 * @method Epidsode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpidsodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Epidsode::class);
    }

    // /**
    //  * @return Epidsode[] Returns an array of Epidsode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Epidsode
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
