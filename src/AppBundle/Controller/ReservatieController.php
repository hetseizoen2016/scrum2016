<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReservatieController extends Controller
{
    /**
     * @Route("/reservatie", name="reservatie")
     */
    public function reservatieAction() {
        /* Openingsuren */
		$em = $this->getDoctrine()->getManager();
		$openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
                
                return $this->render('reservatie/reservatie.html.twig', array(
			'openingsuren' => $openingsuren,
                        'user' => $this->getUser()
		));
    }
}
