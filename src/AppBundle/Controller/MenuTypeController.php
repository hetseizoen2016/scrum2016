<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\MenuType;
use AppBundle\Form\MenuTypeType;

/**
 * MenuType controller.
 *
 *
 */
class MenuTypeController extends Controller
{
    /**
     * Lists all MenuType entities.
     *
     * @Route("/admin/menutype", name="menutype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $menuTypes = $em->getRepository('AppBundle:MenuType')->findAll();

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menutype/index.html.twig', array(
            'menuTypes' => $menuTypes,
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),

        ));
    }

    /**
     * Creates a new MenuType entity.
     *
     * @Route("/admin/menutype/new", name="menutype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $menuType = new MenuType();
        $form = $this->createForm('AppBundle\Form\MenuTypeType', $menuType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menuType);
            $em->flush();

            return $this->redirectToRoute('menutype_index', array('id' => $menuType->getId()));
        }

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menutype/new.html.twig', array(
            'menuType' => $menuType,
            'form' => $form->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
    }

    /**
     * Finds and displays a MenuType entity.
     *
     * @Route("/admin/menutype/{id}", name="menutype_show")
     * @Method("GET")
     */
    public function showAction(MenuType $menuType)
    {
        $deleteForm = $this->createDeleteForm($menuType);

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menutype/show.html.twig', array(
            'menuType' => $menuType,
            'delete_form' => $deleteForm->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
    }

    /**
     * Displays a form to edit an existing MenuType entity.
     *
     * @Route("/admin/menutype/{id}/edit", name="menutype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MenuType $menuType)
    {
        $deleteForm = $this->createDeleteForm($menuType);
        $editForm = $this->createForm('AppBundle\Form\MenuTypeType', $menuType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menuType);
            $em->flush();

            return $this->redirectToRoute('menutype_index', array('id' => $menuType->getId()));
        }

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menutype/edit.html.twig', array(
            'menuType' => $menuType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
    }

    /**
     * Deletes a MenuType entity.
     *
     * @Route("/admin/menutype/{id}", name="menutype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MenuType $menuType)
    {
        $form = $this->createDeleteForm($menuType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menuType);
            $em->flush();
        }

        return $this->redirectToRoute('menutype_index');
    }

    /**
     * Creates a form to delete a MenuType entity.
     *
     * @param MenuType $menuType The MenuType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MenuType $menuType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('menutype_delete', array('id' => $menuType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
