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
           /* $this->redirectToRoute('accueil'); */
        }

        return $this->render('base/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
