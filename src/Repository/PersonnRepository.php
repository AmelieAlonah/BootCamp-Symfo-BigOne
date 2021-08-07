<?php

namespace App\Repository;

use App\Entity\Personn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personn|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personn|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personn[]    findAll()
 * @method Personn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personn::class);
    }

    // /**
    //  * @return Personn[] Returns an array of Personn objects
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
    public function findOneBySomeField($value): ?Personn
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
