<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Entity\Produits;

use  App\Form\MembreType;
use App\Entity\Commandes;

use  App\Form\ProduitsType;

use App\Entity\ProduitsCommandes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{


    //-------------------------------------------------------------------------PRODUITS-----------------------------------------------------------------------------


    /**
     * 
     * @Route("/admin/produits", name="admin_produits")
     * 
     * 
     */
    public function adminProduits()
    {

        $repository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repository->findAll();

        return $this->render('admin/produit_list.html.twig', [
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->redirectToRoute('admin_produits');
    }

    /**
     * 
     * @Route("/admin/produits/add", name="admin_produits_add")
     * 
     * 
     */
    public function adminProduitsAdd(Request $request)
    {
        $produits = new Produits; //objet vide

        // On récupère le formulaire
        $form = $this->createForm(ProduitsType::class, $produits);
        // On récupère les infos saisies dans le formulaire ($_POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($produits);
            // Enregistrer le $produit dans le système 


            $manager->flush();
            // va enregistrer $produit en BDD

            $this->addFlash('success', 'Le produit n°' . $produits->getId() . ' a bien été enregistré en BDD');

            return $this->redirectToRoute('admin_produits');
        }

        return $this->render('admin/produit_form.html.twig', [
            'produitsform' => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/produits/update/{id}", name="admin_produits_update")
     * 
     * 
     */
    public function adminProduitsUpdate($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->find(Produits::class, $id); //objet rempli

        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($produit);


            $manager->flush();

            $this->addFlash('success', 'Le produit n°' . $id . ' a bien été modifié !');
            return $this->redirectToRoute('admin_produits');
        }

        return $this->render('admin/produit_form.html.twig', [
            'produitsform' => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/produits/delete/{id}", name="admin_produits_delete")
     * 
     * 
     */
    public function adminProduitsDelete($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $produits = $manager->find(Produits::class, $id);


        if ($produits->getProduitsCommandes()->isEmpty()) {

            $manager->remove($produits);
            $manager->flush();

            $this->addFlash('success', 'le produit n°' . $id . ' à bien ete supprimer');
        } else {

            $commandes = array();
            foreach ($produits->getProduitsCommandes() as $pc) {
                $commandes[] = $pc->getCommande()->getId();
            }


            $this->addFlash('error', 'Attention le produit n°' . $id . ' est dans une ou plusieurs commandes : ' . implode('-', $commandes)  . '.<br/> Veuillez d\'abord supprimer les commandes');
        }

        return $this->redirectToRoute('admin_produits');
    }


    //-------------------------------------------------------------------------MEMBRES-----------------------------------------------------------------------------


    /**
     * 
     * @Route("/admin/membres", name="admin_membres")
     * 
     * 
     */
    public function adminMembres()
    {

        $repository = $this->getDoctrine()->getRepository(Membres::class);
        $membres = $repository->findAll();

        return $this->render('admin/membre_list.html.twig', [
            'membres' => $membres
        ]);
    }

    /**
     * 
     * @Route("/admin/membres/add", name="admin_membres_add")
     * 
     * 
     */
    public function adminMembresAdd(Request $request)
    {

        $membre = new Membres;

        $form = $this->createForm(MembreType::class, $membre, array(
            'admin' => true
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($membre);
            $password = md5(rand(1, 99999));
            $membre->setPassword($password);
            // Enregistrer le $produit dans le système 

            $manager->flush();
            // va enregistrer $produit en BDD

            $this->addFlash('success', 'Le Membre à bien été enregistré en BDD');
            return $this->redirectToRoute('admin_membres');
        }

        return $this->render('admin/membre_form.html.twig', [
            'membreForm' => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/membres/update/{id}", name="admin_membres_update")
     * 
     * 
     */
    public function adminMembresUpdate($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $membre = $manager->find(Membres::class, $id);


        $form = $this->createForm(MembreType::class, $membre, array(
            'admin' => true
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($membre);

            $manager->flush();

            $this->addFlash('success', 'Le membre n°' . $id . ' a bien été modifié !');
            return $this->redirectToRoute('admin_membres');
        }

        return $this->render('admin/membre_form.html.twig', [
            'membreForm' => $form->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/membres/delete/{id}", name="admin_membres_delete")
     * 
     * 
     */
    public function adminMembresDelete($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $membre = $manager->find(Membres::class, $id);

        $manager->remove($membre);

        $manager->flush();

        $this->addFlash('success', 'le Membre n°' . $id . ' a bien ete supprimer');
        return $this->redirectToRoute('admin_membres');
    }


    //-------------------------------------------------------------------------COMMANDES-----------------------------------------------------------------------------


    /**
     * 
     * @Route("/admin/commandes", name="admin_commandes")
     * 
     * 
     */
    public function adminCommandes()
    {

        $repository = $this->getDoctrine()->getRepository(Commandes::class);
        $commandes = $repository->findAll();

        return $this->render('admin/commande_list.html.twig', [
            'commandes' => $commandes
        ]);
    }

    /**
     * 
     * @Route("/admin/commandes/add", name="admin_commandes_add")
     * 
     * 
     */
    public function adminCommandesAdd()
    {

        $repository = $this->getDoctrine()->getRepository(ProduitsCommandes::class);
        $produitscommandes = $repository->findAll();

        $repository = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repository->findAll();
        $type = $repository->findAllDisctinctProduitsType();

        $repository = $this->getDoctrine()->getRepository(Membres::class);
        $membres = $repository->findAll();

        return $this->render('admin/commande_form.html.twig', [
            'produitscommandes' => $produitscommandes,
            'produits' => $produits,
            'membres' => $membres,
            'type' => $type,
        ]);
    }









    /**
     * 
     * @Route("/admin/ajax/univers_list", name="admin_ajax_univers_list")
     * Route qui permet de récupérer la liste des univers en fonction du type de produit dans le process de création d'une commande 
     * 
     */
    public function adminAjaxUniversList(Request $request){
        
        $type = $request -> request -> get('type');

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $univers = $repo -> findUniversByType($type);

        return $this -> json($univers);

    }

    /**
     * 
     * @Route("/admin/ajax/produit_list", name="admin_ajax_produit_list")
     * Route qui permet de récupérer la liste des produit en fonction du type de produit, et de l'univers dans le process de creation d'une commande 
     * 
     */
    public function adminAjaxProduitList(Request $request){

        $type = $request -> request -> get('type');
        $univers = $request -> request -> get('univers');

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produits = $repo -> findProduitByTypeAndUnivers($type, $univers);

        return $this -> json($produits);


    }

    /**
     * @Route("/admin/ajax/produit", name="admin_ajax_produit")
     */
    public function adminAjaxProduit(Request $request) {

        $produitRequete = $request->request->get('produit');

        $repo = $this->getDoctrine()->getRepository(Produits::class);
        $produit = $repo->findBy('');

        return $this->json($produit);

    }


    /**
     * 
     * @Route("/admin/commandes/update/{id}", name="admin_commandes_update")
     * 
     * 
     */
    public function adminCommandesUpdate($id)
    {
        return $this->render('admin/commande_form.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/commandes/delete/{id}", name="admin_commandes_delete")
     * 
     * 
     */
    public function adminCommandesDelete($id)
    {
        return $this->redirect('admin_commandes');
    }
}
