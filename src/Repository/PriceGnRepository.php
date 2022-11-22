<?php

namespace App\Repository;

use App\Entity\PriceGn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriceGn|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceGn|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceGn[]    findAll()
 * @method PriceGn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceGnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceGn::class);
    }

    // /**
    //  * @return PriceGn[] Returns an array of PriceGn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceGn
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
