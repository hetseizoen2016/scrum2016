<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class NieuwsController extends Controller{

	/**
	* @Route("/nieuws", name="nieuws")
	*/
	public function nieuwsAction(){

		/* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
        
        return $this->render('nieuws/nieuws.html.twig', array(
            'openingsuren' => $openingsuren,
        ));
	}
}