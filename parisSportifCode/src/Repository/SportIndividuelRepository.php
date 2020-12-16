<?php

namespace App\Repository;

use App\Entity\SportIndividuel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SportIndividuel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SportIndividuel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SportIndividuel[]    findAll()
 * @method SportIndividuel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportIndividuelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportIndividuel::class);
    }

    // /**
    //  * @return SportIndividuel[] Returns an array of SportIndividuel objects
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
    public function findOneBySomeField($value): ?SportIndividuel
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
