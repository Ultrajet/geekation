<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\MembreType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MembreController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request)
    {	
        
        $membre = new Membres;
        
        $form = $this->createForm(MembreType::class, $membre);
        $form -> handleRequest($request);
        
		return $this -> render('membre/inscription.html.twig', [
            'membreForm' => $form -> createView()
         	]);
    }


     /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render('membre/profil.html.twig', [
           
        ]);
    }

     /**
     * @Route("/profil/modifier_profil", name="modification_profil")
     */
    public function modifier_profil()
    {
        return $this->render('membre/inscription.html.twig', [
           
        ]);
    }

 /**
     * @Route("/gestion_panier", name="gestion_panier")
     */
    public function gestion_panier()
    {
        return $this->render('membre/gestion_panier.html.twig', [
          
        ]);
    }

     /**
     * @Route("/historique_commandes", name="historique_commandes")
     */
    public function historique_commandes()
    {
        return $this->render('membre/historique_commandes.html.twig', [
        ]);
    }
}
