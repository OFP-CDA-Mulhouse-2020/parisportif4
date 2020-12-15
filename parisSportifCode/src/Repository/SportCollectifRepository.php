<?php

namespace App\Repository;

use App\Entity\SportCollectif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SportCollectif|null find($id, $lockMode = null, $lockVersion = null)
 * @method SportCollectif|null findOneBy(array $criteria, array $orderBy = null)
 * @method SportCollectif[]    findAll()
 * @method SportCollectif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SportCollectifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportCollectif::class);
    }

    // /**
    //  * @return SportCollectif[] Returns an array of SportCollectif objects
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
    public function findOneBySomeField($value): ?SportCollectif
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
