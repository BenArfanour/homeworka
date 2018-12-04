<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Mail ;
use AppBundle\Form\MailType ;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations


use Symfony\Component\HttpFoundation\Response;




class DefaultController extends FOSRestController
{

    
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/send")
     */

    public function indexAction(Request $request)
    {
   // $mail = new Mail();
    //$form= $this->createForm(MailType::class, $mail);
    //$form->handleRequest($request) ;
    //if ($form->isValid()) {

    	//$securityContext = $this->container->get('security.authorization_checker');
			//if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
    
					    $message = \Swift_Message::newInstance()
					                ->setSubject('Accusé de réception | Test')
					                ->setFrom('nour.benarfa@esprit.tn')
					                ->setTo('nour.benarfa@med.tn')
  
					                ->setBody(
					                $this->renderView('mail.html.twig'),
					            'text/html'
					                );
					        
					            $this->get('mailer')->send($message);
					        $response = new Response(json_encode(array('success' => true)));
					        $response->headers->set('Content-Type', 'application/json');
					        return $response;
					                
					        
	 }

			//}

			


				//return $this->redirectToRoute('fos_user_security_login');
			

				
			


            //if (! $this->get('mailer')->send($message)) return Response ('failed to send') ;
            //return $this->redirect($this->generateUrl('my_app_mail_accuse'));

}
       // return $this->render('mail/index.html.twig', array('form'=>$form
        //->createView()));
  //    }




    



