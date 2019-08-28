<?php

namespace App\Controller;

use App\Entity\Produits;

use App\Entity\Membres ;

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

        return $this->render('admin/produit_list.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/produits/add", name="admin_produits_add")
     * 
     * 
     */
    public function adminProduitsAdd()
    {
        return $this->render('admin/produit_form.html.twig', []);
    }

    /**
     * 
     * @Route("/admin/produits/update/{id}", name="admin_produits_update")
     * 
     * 
     */
    public function adminProduitsUpdate($id)
    {
        return $this->render('admin/produit_form.html.twig', []);
    }
    
    /**
     * 
     * @Route("/admin/produits/delete/{id}", name="admin_produits_delete")
     * 
     * 
     */
    public function adminProduitsDelete($id)
    {
        return $this->redirect('admin_produits');
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
