<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/reservatieajax", name="reservatieajax")
     */
    public function ajaxAction(Request $request) {
        $waarden = $request->query->all();
        
        $return = array("datum" => $waarden["datum"], "personen" => $waarden["personen"]);
        
        return new Response(json_encode($return));
    }

}
