<?php 

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
* @Route("/menu")
*/
class MenuController extends Controller{

	/**
	* @Route("/", name="menu")
	*/
	public function menuAction(){

		return $this->render('menu/menu.html.twig', array());
	}
}