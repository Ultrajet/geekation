<?php

namespace App\Controller;

use App\Entity\Produits;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;

class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ObjectManager $manager)
    {
        $produits = $this->getDoctrine()->getRepository(Produits::class)->findAllDisctinctProduits();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="produit")
     */
    public function produit($slug)
    {
        $produit = $this->getDoctrine()->getRepository(Produits::class)->findOneBy(['slug' => $slug]);

        return $this->render('produit/show.html.twig', [
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/ajoutpanier/{slug}"), name="ajoutpanier")
     */
    public function ajoutPanier($slug, Request $request)
    {
        $session = $request->getSession();

        if (!$session->get("panier")) {
            $panier = $session->set("panier", []);
        };

        $panier = $session->get("panier");
        
        $nb = count($panier) + 1;
        $panier[$nb] = $produit->getSlug();
        $session->set("panier", $panier);

        return $this->redirectToRoute("ajoutPanier", ['slug' => $slug]);
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
