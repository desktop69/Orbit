<?php

namespace App\Repository;

use App\Entity\Orbit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Orbit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orbit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orbit[]    findAll()
 * @method Orbit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrbitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orbit::class);
    }

     /**
      * @return Orbit[] Returns an array of Orbit objects
      */
   
      public function findBypernat()
      {
          
          $qb = $this->createQueryBuilder('o');
          
              
             
          return $qb->getQuery()->getResult();
      }
      
      public function findLastInserted()
      {
          return $this
              ->createQueryBuilder("e")
              ->orderBy("id", "DESC")
              ->setMaxResults(1)
              ->getQuery()
              ->getOneOrNullResult();
      }
  

    /*
    public function findOneBySomeField($value): ?Orbit
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
