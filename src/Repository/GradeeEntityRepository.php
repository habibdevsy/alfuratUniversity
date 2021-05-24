<?php

namespace App\Repository;

use App\Entity\GradeeEntity;
use App\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method GradeeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method GradeeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method GradeeEntity[]    findAll()
 * @method GradeeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GradeeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GradeeEntity::class);
    }
    
    public function getUserByUserName($userName){
        
        return $this->createQueryBuilder('GradeeEntity')

        ->leftJoin(UserEntity::class, 'UserEntity', Join::WITH, 'UserEntity = GradeeEntity.user')

        ->andWhere('UserEntity.userName = :userName')
        ->setParameter('userName', $userName)
        ->getQuery()
        ->getResult();
    }
    public function getUserBy($id){
        
        return $this->createQueryBuilder('GradeeEntity')

        ->leftJoin(UserEntity::class, 'UserEntity', Join::WITH, 'UserEntity = GradeeEntity.user')

        ->andWhere('UserEntity.id = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
    }

    public function getGradeById($id){
        
        return $this->createQueryBuilder('GradeeEntity')
        ->andWhere('GradeeEntity.user = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
    }
}
