<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 7/04/2016
 * Time: 9:02
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReserveringenOverzichtController extends Controller
{
    /**
     * Lists all Reserveringen.
     *
     * @Route("/admin/reservatie/overzicht", name="overzicht")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        //$em = $this->getDoctrine()->getManager();

        //$menuTypes = $em->getRepository('AppBundle:MenuType')->findAll();

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/overzicht.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),

        ));
    }
}