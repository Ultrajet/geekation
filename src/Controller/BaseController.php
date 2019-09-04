<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function Formulaire(Request $request, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $notification -> notify($contact);
            $this->addFlash('success', 'Votre mail a bien été envoyé !');
            $this->redirectToRoute('accueil'); 
        }

        return $this->render('base/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/cgv", name="cgv")
     */
    public function cgv(){
        return $this->render('footer/cgv.html.twig', []);
    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function cgu(){
        return $this->render('footer/cgu.html.twig', []);
    }

    /**
     * @Route("/cookies", name="cookies")
     */
    public function cookies(){
        return $this->render('footer/cookies.html.twig', []);
    }

    /**
     * @Route("/mentions_legales", name="mentions_legales")
     */
    public function mentionsLegales(){
        return $this->render('footer/mentions_legales.html.twig', []);
    }

    /**
     * @Route("/protection_des_donnes", name="protection_des_donnes")
     */
    public function protectionDesDonnees(){
        return $this->render('footer/protection_des_donnes.html.twig', []);
    }
}
