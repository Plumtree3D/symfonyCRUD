<?php

namespace App\Repository;

use App\Entity\PresCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PresCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresCard[]    findAll()
 * @method PresCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresCard::class);
    }

    // /**
    //  * @return PresCard[] Returns an array of PresCard objects
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
    public function findOneBySomeField($value): ?PresCard
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
