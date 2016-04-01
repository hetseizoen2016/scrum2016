<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Openingsuur;
use AppBundle\Form\OpeningsuurType;

/**
 * Openingsuur controller.
 *
 *
 */
class OpeningsuurController extends Controller
{
    /**
     * Lists all Openingsuur entities.
     *
     * @Route("/admin/uren/", name="uren_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /* Openingsuren in footer */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('openingsuur/index.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser()
        ));
    }

    /**
     * Creates a new Openingsuur entity.
     *
     * @Route("/admin/uren/new", name="uren_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $openingsuur = new Openingsuur();
        $form = $this->createForm('AppBundle\Form\OpeningsuurType', $openingsuur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($openingsuur);
            $em->flush();

            return $this->redirectToRoute('uren_show', array('id' => $openingsuur->getId()));
        }

        /* Openingsuren in footer */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();


        return $this->render('openingsuur/new.html.twig', array(
            'openingsuren' => $openingsuren,
            'form' => $form->createView(),
            'user' => $this->getUser()
        ));
    }

    /**
     * Finds and displays a Openingsuur entity.
     *
     * @Route("/admin/uren/{id}", name="uren_show")
     * @Method("GET")
     */
    public function showAction(Openingsuur $openingsuur)
    {
        $deleteForm = $this->createDeleteForm($openingsuur);

        /* Openingsuren in footer */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('openingsuur/show.html.twig', array(
            'openingsuren' => $openingsuren,
            'openingsuur' => $openingsuur,
            'delete_form' => $deleteForm->createView(),
            'user' => $this->getUser()
        ));
    }

    /**
     * Displays a form to edit an existing Openingsuur entity.
     *
     * @Route("admin/uren/{id}/edit", name="uren_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Openingsuur $openingsuur)
    {
        $deleteForm = $this->createDeleteForm($openingsuur);
        $editForm = $this->createForm('AppBundle\Form\OpeningsuurType', $openingsuur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($openingsuur);
            $em->flush();

            return $this->redirectToRoute('uren_edit', array('id' => $openingsuur->getId()));
        }

        /* Openingsuren in footer */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('openingsuur/edit.html.twig', array(
            'openingsuren' => $openingsuren,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'openingsuur' => $openingsuur,
            'user' => $this->getUser()
        ));
    }

    /**
     * Deletes a Openingsuur entity.
     *
     * @Route("/admin/uren/{id}", name="uren_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Openingsuur $openingsuur)
    {
        $form = $this->createDeleteForm($openingsuur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($openingsuur);
            $em->flush();
        }

        return $this->redirectToRoute('uren_index');
    }

    /**
     * Creates a form to delete a Openingsuur entity.
     *
     * @param Openingsuur $openingsuur The Openingsuur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Openingsuur $openingsuur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('uren_delete', array('id' => $openingsuur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
