<?php

namespace App\Repository;

use App\Entity\CollegeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeEntity[]    findAll()
 * @method CollegeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeEntity::class);
    }

    // /**
    //  * @return CollegeEntity[] Returns an array of CollegeEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CollegeEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
