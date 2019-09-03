<?php

namespace App\Controller;

use App\Entity\Produits;
use  App\Form\ProduitsType;

use App\Entity\Membres ;
use  App\Form\MembresType;

use App\Entity\Commandes ;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request ;

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

        $repository = $this-> getDoctrine() ->getRepository(Produits::class);
        $produits= $repository->findAll();

        return $this->render('admin/produit_list.html.twig', [
            'produits' => $produits
        ]);
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
        $form = $this -> createForm(ProduitsType::class, $produits); 
        // On récupère les infos saisies dans le formulaire ($_POST)
        $form -> handleRequest($request);
        
        if($form -> isSubmitted() && $form -> isValid()){
 
             $manager = $this -> getDoctrine() -> getManager();
             $manager -> persist($produits);
             // Enregistrer le $produit dans le système 

        
             $manager -> flush();
             // va enregistrer $produit en BDD
        
             $this -> addFlash('success', 'Le produit n°' . $produits -> getId() . ' a bien été enregistré en BDD');
        
             return $this -> redirectToRoute('admin_produits');
        }

        return $this->render('admin/produit_form.html.twig', [
            'produitsform' => $form ->createView()
        ]);
    }

    /**
     * 
     * @Route("/admin/produits/update/{id}", name="admin_produits_update")
     * 
     * 
     */
    public function adminProduitsUpdate($id,Request $request)
    {
        $manager = $this -> getDoctrine() -> getManager();   
        $produit = $manager -> find(Produits::class, $id); //objet rempli
        
        $form = $this -> createForm(ProduitsType::class, $produit);
        $form -> handleRequest($request);
        
        if($form -> isSubmitted() && $form -> isValid()){
        
            $manager -> persist($produit);


            $manager -> flush(); 
            
            $this -> addFlash('success', 'Le produit n°' . $id . ' a bien été modifié !');
            return $this -> redirectToRoute('admin_produits');
        }
        
        return $this -> render('admin/produit_form.html.twig', [
         'produitsform' => $form -> createView()
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


        if($produits -> getProduitsCommandes() -> isEmpty()){

            $manager->remove($produits);
            $manager->flush();

            $this->addFlash('success', 'le produit n°' . $id . ' à bien ete supprimer');
        }
        else{

            $commandes = array();    
            foreach($produits -> getProduitsCommandes() as $pc){
                $commandes[] = $pc -> getCommande() -> getId();
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
        return $this->render('admin/membre_list.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/membres/add", name="admin_membres_add")
     * 
     * 
     */
    public function adminMembresAdd()
    {
        return $this->render('admin/membre_form.html.twig', []);
    }
        
    /**
     * 
     * @Route("/admin/membres/update/{id}", name="admin_membres_update")
     * 
     * 
     */
    public function adminMembresUpdate($id)
    {
        return $this->render('admin/membre_form.html.twig', []);
    }
        
    /**
     * 
     * @Route("/admin/membres/delete/{id}", name="admin_membres_delete")
     * 
     * 
     */
    public function adminMembresDelete($id)
    {
        return $this->redirect('admin_membres');
    }


    //-------------------------------------------------------------------------COMMANDES-----------------------------------------------------------------------------

    
    /**
     * 
     * @Route("/admin/commandes", name="admin_comandes")
     * 
     * 
     */
    public function adminCommandes()
    {
        return $this->render('admin/commande_list.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/commandes/add", name="admin_comandes_add")
     * 
     * 
     */
    public function adminCommandesAdd()
    {
        return $this->render('admin/commande_form.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/commandes/update/{id}", name="admin_comandes_update")
     * 
     * 
     */
    public function adminCommandesUpdate($id)
    {
        return $this->render('admin/commande_form.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/commandes/delete/{id}", name="admin_comandes_delete")
     * 
     * 
     */
    public function adminCommandesDelete($id)
    {
        return $this->redirect('admin_commandes');
    }
    
}
