<?php

namespace App\Repository;

use App\Entity\Wilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Wilder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wilder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wilder[]    findAll()
 * @method Wilder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WilderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wilder::class);
    }

    // /**
    //  * @return Wilder[] Returns an array of Wilder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wilder
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
