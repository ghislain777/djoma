<?php

namespace App\Repository;

use App\Entity\Emissionradio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emissionradio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emissionradio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emissionradio[]    findAll()
 * @method Emissionradio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmissionradioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emissionradio::class);
    }

    // /**
    //  * @return Emissionradio[] Returns an array of Emissionradio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Emissionradio
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
