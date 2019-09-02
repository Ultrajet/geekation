<?php

namespace App\Controller;

use DateTime;
use App\Entity\Produits;
use App\Entity\ProduitsCommandes;
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
    public function produit($slug, Request $request)
    {
        $produit = $this->getDoctrine()
        ->getRepository(Produits::class)
        ->findOneBy(['slug' => $slug]);

        $produitCommande = $this->getDoctrine()
        ->getRepository(ProduitsCommandes::class)
        ->findOneBy(['produit' => ($produit->getId())]);

        $produitId = $produit->getId();

        $dateNow = new DateTime();
        $dateArray = [$dateNow->format('d/m')];
        for ($i = 0; $i < 7; $i++) {
            array_push($dateArray, $dateNow->modify('+1 day')->format('d/m'));
        }

        // $produitCommande = $produit->a();

        // if ($this->handleRequest($request)) {
        //     echo "Ouais!";
        // }

        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'produitCommande' => $produitCommande,
            'produitId' => $produitId,
            'dates' => $dateArray
        ]);
    }

    /**
     * @Route("/produit2/{slug}", name="produit")
     */
    public function produit2($slug, Request $request)
    {
        $produit = $this->getDoctrine()
        ->getRepository(Produits::class)
        ->findOneBy(['slug' => $slug]);

        $produitCommande = $this->getDoctrine()
        ->getRepository(ProduitsCommandes::class)
        ->findOneBy(['produit' => ($produit->getId())]);

        $produitId = $produit->getId();

        $dateNow = new DateTime();
        $dateArray = [$dateNow->format('d/m')];
        for ($i = 0; $i < 7; $i++) {
            array_push($dateArray, $dateNow->modify('+1 day')->format('d/m'));
        }

        // $produitCommande = $produit->a();

        // if ($this->handleRequest($request)) {
        //     echo "Ouais!";
        // }

        return $this->render('produit/show2.html.twig', [
            'produit' => $produit,
            'produitCommande' => $produitCommande,
            'produitId' => $produitId,
            'dates' => $dateArray
        ]);
    }

    /**
     * @Route("/ajoutpanier/{slug}", name="ajoutpanier", methods={"POST"})
     */
    public function ajoutPanier($slug, Request $request)
    {
        $session = $request->getSession();

        if (!$session->get("panier")) {
            $panier = $session->set("panier", []);
        };

        $panier = $session->get("panier");

        $nom = $request->request->get('nom');
        $date_debut = $request->request->get('date_debut');
        $date_fin = $request->request->get('date_fin');
        $prix = $request->request->get('prix');

        array_push($panier, [$nom, $date_debut, $date_fin, $prix, $slug]);
        $session->set("panier", $panier);

        return $this->redirectToRoute("gestion_panier");
    }

    /**
     * @Route("/viderpanier", name="viderpanier")
     */
    public function viderPanier(Request $request)
    {
        $session = $request->getSession();

        if ($session->get("panier")) {
            $panier = $session->set("panier", []);
        };
 
        return $this->redirectToRoute("gestion_panier");
    }

    /**
     * @Route("/vidersession", name="vidersession")
     */
    public function viderSession(Request $request)
    {
        $request->getSession()->clear();
 
        return $this->redirectToRoute("gestion_panier");
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
