<?php

namespace App\Controller;

use App\Entity\Produits;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ObjectManager $manager)
    {
        $produits = $manager->getRepository(Produits::class)->findAllDisctinctProduits();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produit/{id}", name="produit")
     */
    public function produit($id)
    {
        return $this->render('produit/show.html.twig', []);
    }

    /**
     * @Route("/type/{type}", name="type")
     */
    public function type($type)
    {
        return $this->render('produit/index.html.twig', []);
    }

    /**
     * @Route("/univers/{uni}", name="univers")
     */
    public function universCategories($uni)
    {
        return $this->render('produit/index.html.twig', []);
    }

    /**
     * @Route("/univers", name="univers")
     */
    public function univers()
    {
        return $this->render('produit/univers.html.twig', []);
    }

    /**
     * @Route("/recherche/{term}", name="recherche")
     */
    public function recherche($term)
    {
        return $this->render('produit/index.html.twig', []);
    }
}
