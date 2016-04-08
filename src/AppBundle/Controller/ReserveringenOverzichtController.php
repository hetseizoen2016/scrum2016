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
     * @Route("/admin/reservatie/overzicht", name="reservatie_overzicht")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        $reservatiesArray = array();

        $em = $this->getDoctrine()->getManager();
        $reservaties = $em->getRepository('AppBundle:Reservatie')->findAll();

        foreach ($reservaties as $reservatie) {

            $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($reservatie->getId());
            $menuFormulesArray = array();

            foreach ($reservatieRegels as $reservatieRegel) {

                $menuFormule = $em->getRepository('AppBundle:MenuFormules')->find($reservatieRegel->getFormuleId());
                $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
                array_push($menuFormulesArray, $menuFormule);
            }

            $reservatie->setReservatieRegels($menuFormulesArray);
            array_push($reservatiesArray, $reservatie);
        }

        $reservaties = $reservatiesArray;

        //var_dump($reservaties);

        /* Openingsuren in footer */
        //$em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/overzicht.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
            'reservaties' => $reservaties,
        ));

    }
}