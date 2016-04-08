<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 31/03/2016
 * Time: 10:00
 */
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\MenuFormules;
use AppBundle\Entity\MenuType;
use AppBundle\Form\MenuFormulesType;



/**
 * MenuFormules controller.
 *
 *
 */
class MenuFormulesController extends Controller
{
    /**
     * Lists all MenuFormules entities.
     *
     * @Route("/admin/formules", name="formules_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        /* MenuFormules */
        //$em = $this->getDoctrine()->getManager();
        $menuFormules = $em->getRepository('AppBundle:MenuFormules')->findAll();

        //$menuType = $em->getRepository('AppBundle:MenuType')->find(1);
        //echo $menuType->getName();

        $menuFormulesArray = array();

        foreach ($menuFormules as $menuFormule) {
           //$menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
            $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
            array_push($menuFormulesArray, $menuFormule);
        }

        //var_dump($menuFormulesArray);

        return $this->render('menuformules/index.html.twig', array(
            'menuFormules' => $menuFormulesArray,
            'openingsuren' => $openingsuren,
            'user' => $this->getUser()
        ));
    }

    /**
     * Creates a new MenuFormules entity.
     *
     * @Route("/admin/formules/new", name="formules_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $menuFormule = new MenuFormules();
        $form = $this->createForm('AppBundle\Form\MenuFormulesType', $menuFormule);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $menuFormule->setMenutypeId($menuFormule->getMenuType()->getId());

            //var_dump($menuFormule);


            $em = $this->getDoctrine()->getManager();
            $em->persist($menuFormule);
            $em->flush();

            return $this->redirectToRoute('formules_show', array('id' => $menuFormule->getId()));
        }

        $em = $this->getDoctrine()->getManager();
        $menuType = $em->getRepository('AppBundle:MenuType')->findAll();

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menuformules/new.html.twig', array(
            'menuFormule' => $menuFormule,
            'form' => $form->createView(),
            'menutype' => $menuType,
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
    }

    /**
     * Finds and displays a MenuFormules entity.
     *
     * @Route("/admin/formules/{id}", name="formules_show")
     * @Method("GET")
     */
    
    /* wordt niet gebruikt */
    public function showAction(MenuFormules $menuFormule)
    {
        $deleteForm = $this->createDeleteForm($menuFormule);
        var_dump($menuFormule);
        //$menuFormule->setMenutypeId($menuFormule->getMenuType()->getId());

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menuformules/show.html.twig', array(
            'menuFormule' => $menuFormule,
            'delete_form' => $deleteForm->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser()
        ));
    }

    /**
     * Displays a form to edit an existing MenuFormules entity.
     *
     * @Route("/admin/formules/{id}/edit", name="formules_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MenuFormules $menuFormule)
    {
        $deleteForm = $this->createDeleteForm($menuFormule);

        $em = $this->getDoctrine()->getManager();
        $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));

        //var_dump($menuFormule);

        $editForm = $this->createForm('AppBundle\Form\MenuFormulesType', $menuFormule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $menuFormule->setMenutypeId($menuFormule->getMenuType()->getId());

            $em->persist($menuFormule);
            $em->flush();

            return $this->redirectToRoute('formules_index', array('id' => $menuFormule->getId()));
        }

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('menuformules/edit.html.twig', array(
            'menuFormule' => $menuFormule,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser()
        ));
    }

    /**
     * Deletes a MenuFormules entity.
     *
     * @Route("/admin/{id}", name="formules_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MenuFormules $menuFormule)
    {
        $form = $this->createDeleteForm($menuFormule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menuFormule);
            $em->flush();
        }

        return $this->redirectToRoute('formules_index');
    }

    /**
     * Creates a form to delete a MenuFormules entity.
     *
     * @param MenuFormules $menuFormule The MenuFormules entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MenuFormules $menuFormule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formules_delete', array('id' => $menuFormule->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
