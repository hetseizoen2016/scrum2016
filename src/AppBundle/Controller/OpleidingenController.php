<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 30/03/2016
 * Time: 11:17
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OpleidingenController extends Controller
{

    /**
     * @Route("/opleidingen", name="opleidingen")
     */
    public function homeAction(){

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
        
        return $this->render('opleidingen/index.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser()
        ));
    }
}