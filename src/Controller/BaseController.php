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

public function Formulaire(Request $request, \Swift_Mailer $mailer){

    $form = $this->createForm(ContactType::class, null);
    $form -> handleRequest($request);

        // traitement des infos du formulaire

        if($form -> isSubmitted() && $form -> isValid()){

            $data = $form -> getData();
            // permet de récupérer toutes les infos du formulaire
            // prenom = $data['prenom']
            // objet = $data['objet']

            if($this -> sendEmail($data, $mailer)){
                // $mailer : objet swiftmailer
                $this -> addFlash('success', 'Votre email a été envoyé et sera traité dans les meilleurs délais.');
                return $this->redirectToRoute("contact");
            }
            else{
                $this -> addFlash('errors', 'Un problème a eu lieu durant l\'envoie, veuillez ré-essayer plus tard');
            }
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
        // Affichage de la vue



    /**
    * Permet d'envoyer des emails
    *
    */
    public function sendEmail($data, \Swift_Mailer $mailer){
    $mail = new \Swift_Message();
    // On instancie un objet swiftmailer en précisant l'objet (sujet) du mail.

    $mail
        -> setSubject($data['objet'])
        -> setFrom($data['email'])
        -> setTo('contact@geekation.com')
        -> setBody(
        $this -> renderView('emails/contact.html.twig', [
            'data' => $data
        ]), 'text/html'
        )
    ;

    if($mailer -> send($mail)){
        return true;
    }
    else{
        return false;
    }
    }
}
