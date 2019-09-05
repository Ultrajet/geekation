<?php

namespace App\Controller;

use DateTime;
use DateInterval;
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
        // ----------------------
        // FICHE PRODUIT
        // ----------------------

        // il faut /produit/{slug} dans l'URL : ce {slug} sert à sélectionner le premier examplaire du produit qui apparait dans la table Produits, et afficher ses infos dans la vue
        $produit = $this->getDoctrine()
            ->getRepository(Produits::class)
            ->findOneBy(['slug' => $slug]);

        // par le biais de ce produit sélectionné, on récupère la ou les ProduitsCommandes qui correspondent
        // pour l'instant $produit (qui est un objet) ne contient QU'UN SEUL exemplaire du produit, avec son propre ID
        $produitCommande = $this->getDoctrine()
            ->getRepository(ProduitsCommandes::class)
            ->findOneBy(['produit' => ($produit->getId())]);
        // prochaine étape : regrouper dans un array tous les exemplaires du produit pour ensuite avoir tous les ProduitsCommandes liés au produit global

        // mmmmh...
        $produitId = $produit->getId();

        // c'était pour générer les select des dates de location
        // pourrait servir avec les datepicker... (les objets DateTime sont capricieux à gérer)
        $dateNow = new DateTime();
        $dateArray = [$dateNow->format('d/m')];
        for ($i = 0; $i < 7; $i++) {
            array_push($dateArray, $dateNow->modify('+1 day')->format('d/m'));
        };

        // on envoie tout ça dans le template
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'produitCommande' => $produitCommande
        ]);
    }

    /**
     * @Route("/produit_id/{id}", name="produit_id")
     */
    public function produitId($id, Request $request)
    {
        // ----------------------
        // FICHE PRODUIT
        // ----------------------

        // il faut /produit/{slug} dans l'URL : ce {id} sert à sélectionner le premier examplaire du produit qui apparait dans la table Produits, et afficher ses infos dans la vue
        $produit = $this->getDoctrine()
            ->getRepository(Produits::class)
            ->findOneBy(['id' => $id]);

        // par le biais de ce produit sélectionné, on récupère la ou les ProduitsCommandes qui correspondent
        // pour l'instant $produit (qui est un objet) ne contient QU'UN SEUL exemplaire du produit, avec son propre ID
        $produitCommande = $this->getDoctrine()
            ->getRepository(ProduitsCommandes::class)
            ->findOneBy(['produit' => ($produit->getId())]);
        // prochaine étape : regrouper dans un array tous les exemplaires du produit pour ensuite avoir tous les ProduitsCommandes liés au produit global

        // mmmmh...
        $produitId = $produit->getId();

        // c'était pour générer les select des dates de location
        // pourrait servir avec les datepicker... (les objets DateTime sont capricieux à gérer)
        $dateNow = new DateTime();
        $dateArray = [$dateNow->format('d/m')];
        for ($i = 0; $i < 7; $i++) {
            array_push($dateArray, $dateNow->modify('+1 day')->format('d/m'));
        };

        // on envoie tout ça dans le template
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'produitCommande' => $produitCommande,
            'produitId' => $produitId,
            'dates' => $dateArray
        ]);
    }

    /**
     * @Route("/ajoutpanier", name="ajoutpanier", methods={"POST"})
     */
    public function ajoutPanier(Request $request)
    {
        // ----------------------
        // AJOUT PANIER
        // ----------------------

        // cette route est nécessaire pour ajouter un produit au panier en ajax
        // methods={"POST"} sert à empêcher de taper une URL genre /ajoutpanier/lorem-0 où le {slug} arriverait dans $_GET : celui-ci doit obligatoirement arriver dans $_POST, donc à travers le formulaire de la fiche produit

        // pour commencer, grâce à l'objet Request on récupère l'équivalent de $_SESSION dans Symfony
        $session = $request->getSession();

        // le panier est un tableau array stocké dans $session
        // si celui-ci n'existe pas au moment où on veut ajouter un produit, alors on le crée...
        if (!$session->get("panier")) {
            $panier = $session->set("panier", []);
        };

        // ... dans tous les cas, on le sélectionne
        $panier = $session->get("panier");

        // on récupère les données envoyées depuis la fiche produit
        $nom = $request->request->get('nom');
        $date_debut = $request->request->get('date_debut');
        $date_fin = $request->request->get('date_fin');

        // pour le prix, on multiplie le prix unitaire du produit par le nombre de jours de location
        // donc d'abord, on crée des objets DateTime à partir des dates sélectionnées par l'utilisateur
        $date_debut_obj = DateTime::createFromFormat('d/m/Y', $date_debut);
        $date_fin_obj = DateTime::createFromFormat('d/m/Y', $date_fin);
        // grâce à ces objets on peut utiliser un méthode qui renvoie une valeur qui correspond à la durée de la location
        $dureeLocation = $date_debut_obj->diff($date_fin_obj)->format('%a');
        // plus qu'à multiplier avec le prix
        $prix = $request->request->get('prix') * $dureeLocation;

        // avec array_push, on rajoute un nouvel élément à la fin de $panier, qui sera lui-même un tableau array composé des données recueuillies
        array_push($panier, ['nom' => $nom, 'date_debut' => $date_debut, 'date_fin' => $date_fin, 'prix' => $prix]);
        // prochaine étape : faire en sorte qu'on n'ait plus seulement le nom, le prix et le slug, mais l'objet même de l'exemplaire du produit qu'on souhaite louer

        // après avoir manipulé le panier, on le remet à sa place!
        $session->set("panier", $panier);

        return $this->redirectToRoute("gestion_panier");
    }

    /**
     * @Route("/viderpanier", name="viderpanier")
     */
    public function viderPanier(Request $request)
    {
        // ----------------------
        // VIDER PANIER
        // ----------------------

        // on récupère la session pour voir si elle contient un panier : si c'est le cas, alors il devient un tableau array vide
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
        // ----------------------
        // VIDER SESSION
        // ----------------------

        // l'équivalent de session_destroy(), mais orienté objet (et Symfony-friendly)
        $request->getSession()->clear();
        // utile pour mettre en place un panier qui va toujours réapparaître : au moment où on est redirectToRoute, on revient dans gestion_panier, où on va vérifier s'il y a un panier, puisqu'il n'y en a pas on va en créer un, etc...

        return $this->redirectToRoute("gestion_panier");
    }

    /**
     * @Route("/type", name="type")
     */
    public function type()
    {
        $repository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repository->findACategorie();

        return $this->render('produit/produit_search.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/type/{typ}", name="type_search")
     */
    public function typeSearch($typ)
    {

        $repository = $this->getDoctrine()->getRepository(Produits::class);
        
        $produits = $repository->findProduitDistinctByType($typ);
        //$categories = $repository->findAllTypes();

        return $this->render('produit/produit_search.html.twig', [
            'produits' => $produits,
            //'categories' => $categories
        ]);
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
     * @Route("/recherche/", name="recherche")
     */
    public function recherche(Request $request)
    {

        $term = $request->query->get('s');
        // $term contient la valeur du terme de recherche tapé

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo->findBySearch($term);

        $categories = $repo->findAllTypes();

        return $this->render('produit/produit_search.html.twig', [
            'produits' => $produits,
            'categories' => $categories
        ]);
    }
}
