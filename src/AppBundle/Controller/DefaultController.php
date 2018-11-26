<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Mail ;
use AppBundle\Form\MailType ;

use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
   
    public function indexAction(Request $request)
    {
    $mail = new Mail();
    $form= $this->createForm(MailType::class, $mail);
    $form->handleRequest($request) ;
    if ($form->isValid()) {
    $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('nour.benarfa@esprit.tn')
                ->setTo($mail->getEmail())
                ->setBody(
                $this->renderView(
                'mail.html.twig',
            array('nom' => $mail->getNom(), 'prenom'=>$mail->getPrenom())
                ),
            'text/html'
                );

        
            $this->get('mailer')->send($message);


            if (! $this->get('mailer')->send($message)) return Response ('failed to send') ;
            return $this->redirect($this->generateUrl('my_app_mail_accuse'));

}
        return $this->render('mail/index.html.twig', array('form'=>$form
        ->createView()));
    }



    public function successAction(){
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail
       ."); } 

    
}


