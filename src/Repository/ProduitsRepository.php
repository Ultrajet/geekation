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
            ->select('p.nom', 'p.prix', 'p.type', 'p.univers', 'p.slug', 'p.guid')
            ->distinct(true)
            ->orderBy('p.nom', 'ASC');
        return $builder->getQuery()->getResult();
    }


    /**
     * 
     * 
     * 
     * CATEGORIE
     * 
     * 
     * 
     * 
     */


    /**
     * @return Produit[] Returns an array of Produit objects
     * Fonction pour récupérer toutes les catégories
     */
    public function findProduitDistinctByType($type)
    {
        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p.type','p.nom', 'p.univers', 'p.slug', 'p.guid')
            ->distinct('p.nom')
            ->where('p.type = :type')
            ->setParameter(':type', $type)
            ->orderBy('p.nom', 'ASC');
        return $builder->getQuery()->getResult();
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     * Fonction pour récupérer toutes les catégories
     */
    public function findProduitDistinctByUnivers($univers)
    {
        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p.univers','p.nom', 'p.type', 'p.slug', 'p.guid')
            ->distinct('p.nom')
            ->where('p.univers = :univers')
            ->setParameter(':univers', $univers)
            ->orderBy('p.nom', 'ASC');
        return $builder->getQuery()->getResult();
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     * Fonction pour récupérer toutes les catégories
     */
    public function findAllTypes()
    {
        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p.type')
            ->distinct(true)
            ->orderBy('p.type', 'ASC');
        return $builder->getQuery()->getResult();
    }




    /**
     * 
     * 
     * 
     * PRODUIT COMMAND CRUD
     * 
     * 
     * 
     * 
     */




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


    /**
     * 
     * 
     * 
     * SEARCH
     * 
     * 
     * 
     * 
     */



    /**
     *
     * @return Produit[] Returns an array of Produit objects
     * Fonction pour récupérer tous les produits en fonction d'un terme de recherche
     */
    public function findBySearch($term)
    {

        $term = '%' . $term . '%';
        // switch ==> %switch%

        $builder = $this->createQueryBuilder('p');
        return $builder
            ->where('p.nom LIKE :term')
            ->orWhere('p.type LIKE :term')
            ->orWhere('p.univers LIKE :term')
            ->orWhere('p.slug LIKE :term')
            ->setParameter(':term', $term)
            ->getQuery()
            ->getResult();
    }


    public function findAllByFilter($info)
    {


        $builder = $this->createQueryBuilder('p');
        $builder
            ->select('p');


        if ($info->get('nom') != NULL) {
            $builder
                ->andWhere('p.nom = :nom')
                ->setParameter(':nom', $info->get('nom'));
        }

        if ($info->get('type') != NULL) {
            $builder
                ->andWhere('p.type = :type')
                ->setParameter(':type', $info->get('type'));
        }
        if ($info->get('univers') != NULL) {
            $builder
                ->andWhere('p.univers = :univers')
                ->setParameter(':univers', $info->get('univers'));
        }

        return $builder
            ->getQuery()
            ->getResult();
    }
}
