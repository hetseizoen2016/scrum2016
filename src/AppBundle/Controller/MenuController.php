<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class MenuController extends Controller{

	/**
	* @Route("/menu", name="menu")
	*/
	public function menuAction(){

		/* Openingsuren */
		$em = $this->getDoctrine()->getManager();
		$openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

		/* MenuFormules */
		$menuFormules = $em->getRepository('AppBundle:MenuFormules')->findAllOrderedByNameAndByPrice();
		
                $menuTypes = $em->getRepository('AppBundle:MenuType')->findAll();
                
		return $this->render('menu/menu.html.twig', array(
			'openingsuren' => $openingsuren,
			'menuformules' => $menuFormules,
                        'user' => $this->getUser(),
                        'menutypes' => $menuTypes
		));
	}
}