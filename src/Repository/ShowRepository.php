<?php

namespace App\Repository;

use App\Entity\Show;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Show|null find($id, $lockMode = null, $lockVersion = null)
 * @method Show|null findOneBy(array $criteria, array $orderBy = null)
 * @method Show[]    findAll()
 * @method Show[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Show::class);
    }

    /**
     * @param int $id
     * @return Show[] Returns an array of Show objects 
     */
    public function findWithCollection($id)
    {
        $queryBuilder = $this->createQueryBuilder('show');

        $queryBuilder->where(
            $queryBuilder->expr()->eq('show.id', $id)
        );

        // Joins allows to reduce number of queries to DB
        $queryBuilder->leftJoin('show.categories', 'category');
        $queryBuilder->addSelect('category');

        $queryBuilder->leftJoin('show.seasons', 'season');
        $queryBuilder->addSelect('season');

        $queryBuilder->leftJoin('season.episodes', 'episode');
        $queryBuilder->addSelect('episode');

        $queryBuilder->leftJoin('show.characters', 'character');
        $queryBuilder->addSelect('character');

        return $queryBuilder->getQuery()->getResult();
    }
    // /**
    //  * @return Show[] Returns an array of Show objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Show
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
