<?php

namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    /**
     * @return Produits[] Returns an array of Produits objects
     */

    public function findAllDisctinctProduits()
    {
        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p.nom', 'p.prix', 'p.type', 'p.univers', 'p.slug')
            ->distinct(true)
            ->orderBy('p.nom', 'ASC');
        return $builder->getQuery()->getResult();
    }


    public function findAllDisctinctProduitsType()
    {
        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p.type')
            ->distinct(true)
            ->orderBy('p.type', 'ASC');
        return $builder->getQuery()->getResult();
    }

    public function findUniversByType($type)
    {

        $builder = $this->createQueryBuilder('p');
        return $builder
            ->select('p.univers')
            ->distinct(true)
            ->orderBy('p.univers', 'ASC')
            ->where('p.type = :type')
            ->setParameter(':type', $type)
            ->getQuery()
            ->getResult();
    }
    public function findProduitByTypeAndUnivers($type, $univers)
    {

        $builder = $this->createQueryBuilder('p');
        return $builder
            ->select('p.nom')
            ->distinct(true)
            ->orderBy('p.nom', 'ASC')
            ->where('p.type = :type')
            ->andWhere('p.univers = :univers')
            ->setParameters([':type' => $type, ':univers' => $univers])
            ->getQuery()
            ->getResult();
    }
}
