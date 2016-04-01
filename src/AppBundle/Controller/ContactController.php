<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ContactController extends Controller{

	/**
	* @Route("/contact", name="contact")
	*/
	public function contactAction(){

		/* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
        
        return $this->render('contact/contact.html.twig', array(
            'openingsuren' => $openingsuren,
        ));
	}
}