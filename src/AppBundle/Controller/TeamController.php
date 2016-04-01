<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class TeamController extends Controller{

	/**
	* @Route("/team", name="team")
	*/
	public function menuAction(){

		/* Openingsuren */
		$em = $this->getDoctrine()->getManager();
		$openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
		
		return $this->render('team/team.html.twig', array(
			'openingsuren' => $openingsuren,
                        'user' => $this->getUser()
		));
	}
}