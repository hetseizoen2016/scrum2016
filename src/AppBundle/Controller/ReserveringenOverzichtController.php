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

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT p FROM AppBundle:Reservatie p ORDER BY p.datum ASC');
        $reservaties = $query->getResult();
        $reservatiesArray = array();
        foreach ($reservaties as $reservatie) {

            $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($reservatie->getId());
            $menuFormulesArray = array();

            foreach ($reservatieRegels as $reservatieRegel) {

             //   if (null !== $reservatieRegel->getFormuleId() || null !== $reservatieRegel->getReservatieId() || 0 !== $reservatieRegel->getReservatieId()) {
                if ($reservatieRegel) {
                    $menuFormule = $em->getRepository('AppBundle:MenuFormules')->find($reservatieRegel->getFormuleId());

                    if ($menuFormule) {
                        $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
                        array_push($menuFormulesArray, $menuFormule);
                    }
                }
            }

            $reservatie->setReservatieRegels($menuFormulesArray);
            array_push($reservatiesArray, $reservatie);
        }

        $reservaties = $reservatiesArray;

        /* Openingsuren in footer */
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/overzicht.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
            'reservaties' => $reservaties,
        ));

    }

    /**
     * Lists a reservering.
     *
     * @Route("/admin/reservatie/overzicht/{id}/delete", name="reservatie_overzicht_delete")
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $reservatie = $em->getRepository('AppBundle:Reservatie')->find($id);
        $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($id);

        foreach ($reservatieRegels as $reservatieRegel) {
            $em->remove($reservatieRegel);
        }

        $em->remove($reservatie);
        $em->flush();

        return $this->redirectToRoute('reservatie_overzicht');
    }
}