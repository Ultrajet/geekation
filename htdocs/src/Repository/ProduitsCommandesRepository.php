<?php

namespace App\Repository;

use App\Entity\ProduitsCommandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProduitsCommandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProduitsCommandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProduitsCommandes[]    findAll()
 * @method ProduitsCommandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsCommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProduitsCommandes::class);
    }

    // /**
    //  * @return ProduitsCommandes[] Returns an array of ProduitsCommandes objects
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
    public function findOneBySomeField($value): ?ProduitsCommandes
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
