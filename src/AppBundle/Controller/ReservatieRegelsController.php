<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\ReservatieRegels;
use AppBundle\Form\ReservatieRegelsType;

/**
 * ReservatieRegels controller.
 *
 * 
 */
class ReservatieRegelsController extends Controller
{
    /**
     * Lists all ReservatieRegels entities.
     *
     * @Route("/reservatieregels", name="reservatieregels_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findAll();

        return $this->render('reservatieregels/index.html.twig', array(
            'reservatieRegels' => $reservatieRegels,
        ));
    }

    /**
     * Creates a new ReservatieRegels entity.
     *
     * @Route("/reservatieregels/new", name="reservatieregels_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservatieRegel = new ReservatieRegels();
        $form = $this->createForm('AppBundle\Form\ReservatieRegelsType', $reservatieRegel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservatieRegel);
            $em->flush();

            return $this->redirectToRoute('reservatieregels_show', array('id' => $reservatieRegel->getId()));
        }

        return $this->render('reservatieregels/new.html.twig', array(
            'reservatieRegel' => $reservatieRegel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ReservatieRegels entity.
     *
     * @Route("/reservatieregels/{id}", name="reservatieregels_show")
     * @Method("GET")
     */
    public function showAction(ReservatieRegels $reservatieRegel)
    {
        $deleteForm = $this->createDeleteForm($reservatieRegel);

        return $this->render('reservatieregels/show.html.twig', array(
            'reservatieRegel' => $reservatieRegel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ReservatieRegels entity.
     *
     * @Route("/reservatieregels/{id}/edit", name="reservatieregels_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReservatieRegels $reservatieRegel)
    {
        $deleteForm = $this->createDeleteForm($reservatieRegel);
        $editForm = $this->createForm('AppBundle\Form\ReservatieRegelsType', $reservatieRegel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservatieRegel);
            $em->flush();

            return $this->redirectToRoute('reservatieregels_edit', array('id' => $reservatieRegel->getId()));
        }

        return $this->render('reservatieregels/edit.html.twig', array(
            'reservatieRegel' => $reservatieRegel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ReservatieRegels entity.
     *
     * @Route("/reservatieregels/{id}", name="reservatieregels_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReservatieRegels $reservatieRegel)
    {
        $form = $this->createDeleteForm($reservatieRegel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservatieRegel);
            $em->flush();
        }

        return $this->redirectToRoute('reservatieregels_index');
    }

    /**
     * Creates a form to delete a ReservatieRegels entity.
     *
     * @param ReservatieRegels $reservatieRegel The ReservatieRegels entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservatieRegels $reservatieRegel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservatieregels_delete', array('id' => $reservatieRegel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
