<?php

namespace App\Repository;

use App\Entity\Salaries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Salaries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salaries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salaries[]    findAll()
 * @method Salaries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalariesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salaries::class);
    }

    // /**
    //  * @return Salaries[] Returns an array of Salaries objects
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
    public function findOneBySomeField($value): ?Salaries
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
