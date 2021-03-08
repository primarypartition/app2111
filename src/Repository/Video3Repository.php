<?php

namespace App\Repository;

use App\Entity\Video3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Video3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video3[]    findAll()
 * @method Video3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Video3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video3::class);
    }

    // /**
    //  * @return Video3[] Returns an array of Video3 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Video3
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
