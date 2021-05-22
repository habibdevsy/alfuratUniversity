<?php

namespace App\Repository;

use App\Entity\SubjectEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubjectEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubjectEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubjectEntity[]    findAll()
 * @method SubjectEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubjectEntity::class);
    }

    // /**
    //  * @return SubjectEntity[] Returns an array of SubjectEntity objects
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
    public function findOneBySomeField($value): ?SubjectEntity
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
