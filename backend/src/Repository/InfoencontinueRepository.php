<?php

namespace App\Repository;

use App\Entity\Infoencontinue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Infoencontinue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infoencontinue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infoencontinue[]    findAll()
 * @method Infoencontinue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoencontinueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infoencontinue::class);
    }

    // /**
    //  * @return Infoencontinue[] Returns an array of Infoencontinue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Infoencontinue
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
