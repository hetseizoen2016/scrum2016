<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{


	/**
	* @Route("/", name="index")
	*/	
	public function homeAction(){

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

		return $this->render('homepage/index.html.twig', array(
            'openingsuren' => $openingsuren,
                    'user' => $this->getUser()
        ));
	}
}
