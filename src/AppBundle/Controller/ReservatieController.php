<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Reservatie;
use AppBundle\Form\ReservatieType;


class ReservatieController extends Controller
{

    /**
     * @Route("/reservatie", name="reservatie")
     */
    public function reservatieAction(Request $request) {
        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        $formules = $em->getRepository('AppBundle:MenuFormules')->findAll();
        $types = $em->getRepository('AppBundle:MenuType')->findAll();
        
        $reservatie = new Reservatie();
        $form = $this->createForm('AppBundle\Form\ReservatieType', $reservatie);

        $types = $request->request->get('types');

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $datum = $form["datum"]->getData()->format('Y-m-d');
            $naam = $form["naam"]->getData(); 
            $opdrachtgever = $form["opdrachtgever"]->getData();
            $aantalDeelnemers = $form["aantalDeelnemers"]->getData();
            $aanvang = $form["aanvang"]->getData()->format('H:i:s');
            $commentaar = $form["commentaar"]->getData();
            $afdeling = $form["afdeling"]->getData();
            $product = $form["product"]->getData(); 
            $project = $form["project"]->getData(); 
            $rekening = $form["rekening"]->getData();          

            //$datumtwee = $request->query->get('datum');

            /*$gegevens = array(
                "datum" => $request->request->get('datum'),
                "datumtwee" => $datumtwee
            );*/

            $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('tseizoen@vdab.be')
                ->setTo('vincentvanlerberghe_73@hotmail.com')
                ->setBody(
                    $this->renderView(
                        'email/bevestiging.html.twig',
                        array("datum" => $datum, "naam" => $naam, "opdrachtgever" => $opdrachtgever,
                            "aantalDeelnemers" => $aantalDeelnemers, "aanvang" => $aanvang,
                            "commentaar" => $commentaar, "afdeling" => $afdeling, "product" => $product,
                            "project" => $project, "rekening" => $rekening, "types" => $types)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            return $this->redirectToRoute('index', array(), 301);

            //return $this->redirectToRoute('send_mail', ['request' => $request], 307);
        }
        
        return $this->render('reservatie/reservatie.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
                    'formules' => $formules,
                    'types' => $types,
                    'form' => $form->createView()
        )); 
    }

    /**
    * @Route("/reservatie/send", name="send_mail")
    */
    public function sendAction(Request $request){
        //echo($request->query->get('datum'));
        



        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('tseizoen@vdab.be')
            ->setTo('vincentvanlerberghe_73@hotmail.com')
            ->setBody(
                $this->renderView(
                    'email/bevestiging.html.twig',
                    array('name' => "vincent", 'gegevens' => $gegevens)
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);

        //return $this->redirectToRoute('index', array(), 301);
    }
     /**
     * @Route("/reservatieajax", name="reservatieajax")
     */
    public function ajaxAction(Request $request) {
        $waarden = var_dump($request->query->all());
        
        //$return = array("datum" => $waarden["datum"], "personen" => $waarden["personen"]);
        
        return new Response($waarden);
    }


    /*--------------------------------VANAF HIER IS CRUD GENERATED-------------------------------*/


    /**
     * Lists all Reservatie entities.
     *
     * @Route("/reservatie/index", name="reservatie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservaties = $em->getRepository('AppBundle:Reservatie')->findAll();

        return $this->render('reservatie/index.html.twig', array(
            'reservaties' => $reservaties,
        ));
    }

    /**
     * Creates a new Reservatie entity.
     *
     * @Route("/reservatie/new", name="reservatie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservatie = new Reservatie();
        $form = $this->createForm('AppBundle\Form\ReservatieType', $reservatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservatie);
            $em->flush();

            return $this->redirectToRoute('reservatie_show', array('id' => $reservatie->getId()));
        }

        return $this->render('reservatie/new.html.twig', array(
            'reservatie' => $reservatie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reservatie entity.
     *
     * @Route("/reservatie/{id}", name="reservatie_show")
     * @Method("GET")
     */
    public function showAction(Reservatie $reservatie)
    {
        $deleteForm = $this->createDeleteForm($reservatie);

        return $this->render('reservatie/show.html.twig', array(
            'reservatie' => $reservatie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reservatie entity.
     *
     * @Route("/reservatie/{id}/edit", name="reservatie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservatie $reservatie)
    {
        $deleteForm = $this->createDeleteForm($reservatie);
        $editForm = $this->createForm('AppBundle\Form\ReservatieType', $reservatie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservatie);
            $em->flush();

            return $this->redirectToRoute('reservatie_edit', array('id' => $reservatie->getId()));
        }

        return $this->render('reservatie/edit.html.twig', array(
            'reservatie' => $reservatie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Reservatie entity.
     *
     * @Route("reservatie//{id}", name="reservatie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservatie $reservatie)
    {
        $form = $this->createDeleteForm($reservatie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservatie);
            $em->flush();
        }

        return $this->redirectToRoute('reservatie_index');
    }

    /**
     * Creates a form to delete a Reservatie entity.
     *
     * @param Reservatie $reservatie The Reservatie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservatie $reservatie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservatie_delete', array('id' => $reservatie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
