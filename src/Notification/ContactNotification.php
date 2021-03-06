<?php

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;



class ContactNotification{

    /**
     *
     * @var \Swift_Mailer
    */
   private $mailer;

    /**
    * @var Environment
    */
   private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {

        $this->mailer = $mailer;
        $this->renderer = $renderer;
       
    }

    public function notify(Contact $contact)
    { 
        $message = (new \Swift_Message('Contact'))
            ->setFrom($contact->getEmail())
            ->setTo('marinepelletierbarteau@gmail.com')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');

            return $this->mailer->send($message);
    }

}