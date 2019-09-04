<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Form\MembreType;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MembreController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ObjectManager $manager,  userPasswordEncoderInterface $encoder)
    {
        $membre = new Membres;
        
        $form = $this->createForm(MembreType::class, $membre,array(
            'inscription' => true
        ));
        $form -> handleRequest($request);
        if ($form ->isSubmitted() && $form ->isValid()) {
            $manager -> persist($membre);

            if ($membre -> getDateDeNaissance() -> getTimeStamp() > time() - (18 * 365.25 * 24 * 60 * 60)) {
                $this -> addFlash('error', 'Vous êtes trop jeune !');
                return $this -> redirectToRoute('accueil');
            }

            $membre -> setRole('ROLE_USER');
			
			$password = $membre -> getPassword(); 
			
            $password_crypte = $encoder -> encodePassword($membre, $password);
            
			$membre -> setPassword($password_crypte);


            $manager -> flush();

            $this -> addFlash('success', 'Votre inscription a bien été prise en compte !');
            return $this -> redirectToRoute('connexion');
        }
        
        return $this -> render('membre/inscription.html.twig', [
            'membreForm' => $form -> createView()
             ]);
    }


    /**
    * @Route("/profil", name="profil")
    */
    public function profil(ObjectManager $manager)
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
    public function gestion_panier(Request $request)
    {
        $session = $request->getSession();

        if (!$session->get("panier")) {
            $panier = $session->set("panier", []);
        };

        $panier = $session->all()["panier"];

        // $session = $request->getSession()->all()["panier"];

        return $this->render('membre/gestion_panier.html.twig', [
          'panier' => $panier
        ]);
    }

}
