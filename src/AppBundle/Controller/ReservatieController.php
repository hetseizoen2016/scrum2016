<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReservatieRegels;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Reservatie;
use DateTime;

class ReservatieController extends Controller
{

    /**
     * @Route("/reservatie", name="reservatie")
     * @Method({"GET", "POST"})
     */
    public function reservatieAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $reservatie = new Reservatie();
        $defaultData = array('message' => 'my message');
        $form = $this->createFormBuilder($defaultData)
                ->add('datum', 'date', array(
                    'attr' => array('class' => 'datepicker'),
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Datum'
                        )
                )
                ->add('naam', TextType::class, array(
                    'required' => true,
                    'label' => 'Naam'
                        )
                )
                ->add('email', EmailType::class, array(
                    'required' => false,
                    'label' => 'Email'
                        )
                )
                ->add('telefoon', TextType::class, array(
                    'required' => false,
                    'label' => 'Telefoon'
                        )
                )
                ->add('opdrachtgever', TextType::class, array(
                    'required' => false,
                    'label' => 'Opdrachtgever'
                        )
                )
                ->add('aantalDeelnemers', TextType::class, array(
                    'required' => true,
                    'label' => 'Aantal deelnemers'
                        )
                )
                ->add('aanvang', 'time', array(
                    'attr' => array('class' => 'timepicker'),
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Aankomstuur',
                    //'input' => 'datetime',
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Aankomstuur',                   
                        )
                )
                ->add('commentaar', TextareaType::class, array(
                    'required' => false
                        )
                )
                ->add('afdeling', TextType::class, array(
                    'required' => false,
                    'label' => 'Afdeling'
                        )
                )
                ->add('product', TextType::class, array(
                    'required' => false,
                    'label' => 'Product'
                        )
                )
                ->add('project', TextType::class, array(
                    'required' => false,
                    'label' => 'Project'
                        )
                )
                ->add('rekening', TextType::class, array(
                    'required' => false,
                    'label' => 'Rekening'
                        )
                )
                ->getForm();
        $form->handleRequest($request);

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        $formules = $em->getRepository('AppBundle:MenuFormules')->findAll();
        $types = $em->getRepository('AppBundle:MenuType')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            if (isset($_POST['form']) && isset($_POST['reservatie'])) {

                $datum = $_POST['form']['datum'];
                $naam = $_POST['form']['naam'];
                $email = $_POST['form']['email'];
                $telefoon = $_POST['form']['telefoon'];
                $opdrachtgever = $_POST['form']['opdrachtgever'];
                $aantalDeelnemers = $_POST['form']['aantalDeelnemers'];
                $aanvang = $_POST['form']['aanvang'];
                $commentaar = $_POST['form']['commentaar'];

                if (isset($_POST['form']['afdeling'])) {
                    $afdeling = $_POST['form']['afdeling'];
                } else {
                    $afdeling = null;
                }

                if (isset($_POST['form']['product'])) {
                    $product = $_POST['form']['product'];
                } else {
                    $product = null;
                }

                if (isset($_POST['form']['project'])) {
                    $project = $_POST['form']['project'];
                } else {
                    $project = null;
                }
                if (isset($_POST['form']['rekening'])) {
                    $rekening = $_POST['form']['rekening'];
                } else {
                    $rekening = null;
                }
                $reservatie
                        ->setDatum(new \DateTime($datum))
                        ->setNaam($naam)
                        ->setEmail($email)
                        ->setTelefoon($telefoon)
                        ->setOpdrachtgever($opdrachtgever)
                        ->setAantalDeelnemers(intval($aantalDeelnemers))
                        ->setAanvang(new \DateTime($aanvang))
                        ->setCommentaar($commentaar)
                        ->setAfdeling($afdeling)
                        ->setProduct($product)
                        ->setProject($project)
                        ->setRekening($rekening);

                $em->persist($reservatie);
                $em->flush();

                if ($reservatie->getId() > 0) {

                    foreach ($_POST['reservatie'] as $key => $value) {
                        $reservatieRegel = new ReservatieRegels();
                        if ($value > 0) {
                            $reservatieRegel
                                    ->setReservatieId($reservatie->getId())
                                    ->setFormuleId($value);
                            $em->persist($reservatieRegel);
                            $em->flush();
                        }
                    }
                }
                
                $totaal = 0;
                $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($reservatie->getId());
                foreach ($reservatieRegels as $reservatieRegel) {

                    if (null !== $reservatieRegel->getFormuleId() || null !== $reservatieRegel->getReservatieId() || 0 !== $reservatieRegel->getReservatieId()) {
                        $menuFormule = $em->getRepository('AppBundle:MenuFormules')->find($reservatieRegel->getFormuleId());
                        if (null !== $menuFormule->getMenutypeId()) {
                            $totaal += $menuFormule->getPrice();
                        }
                    }
                }
                $totaal = $totaal * $aantalDeelnemers;
                
                $reservatie->setTotaal($totaal);
                
                $em->persist($reservatie);
                $em->flush();
            }

            $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($reservatie->getId());
            $menuFormulesArray = array();
            
            foreach ($reservatieRegels as $reservatieRegel) {

                if (null !== $reservatieRegel->getFormuleId() || null !== $reservatieRegel->getReservatieId() || 0 !== $reservatieRegel->getReservatieId()) {
                    $menuFormule = $em->getRepository('AppBundle:MenuFormules')->find($reservatieRegel->getFormuleId());
                    if (null !== $menuFormule->getMenutypeId()) {
                        $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
                    }
                }
                array_push($menuFormulesArray, $menuFormule);
            }


            

            $message = \Swift_Message::newInstance()
                    ->setSubject('Nieuwe aanvraag tot reservatie')
                    ->setFrom('tseizoen@vdab.be')
                    ->setTo('tseizoen@vdab.be')
                    ->setBody(
                    $this->renderView(
                            'email/bevestiging.html.twig', array("datum" => $datum, "naam" => $naam, "opdrachtgever" => $opdrachtgever,
                        "aantalDeelnemers" => $aantalDeelnemers, "aanvang" => $aanvang,
                        "commentaar" => $commentaar, "afdeling" => $afdeling, "product" => $product,
                        "project" => $project, "rekening" => $rekening, "types" => $types, "email" => $email, "telefoon" => $telefoon, "formules" => $menuFormulesArray, "totaal" => $totaal)
                    ), 'text/html'
            );
            $this->get('mailer')->send($message);
            return $this->redirectToRoute('bevestiging', array("reservatieId" => $reservatie->getId()));
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
     * @Route("/bevestiging", name="bevestiging")
     */
    public function bevestigingsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $reservatieId = $request->query->get("reservatieId");

        $reservatie = $em->getRepository('AppBundle:Reservatie')->find($reservatieId);
        $reservatieRegels = $em->getRepository('AppBundle:ReservatieRegels')->findByReservatieId($reservatieId);
        $menuFormulesArray = array();

        foreach ($reservatieRegels as $reservatieRegel) {

            if (null !== $reservatieRegel->getFormuleId() || null !== $reservatieRegel->getReservatieId() || 0 !== $reservatieRegel->getReservatieId()) {
                $menuFormule = $em->getRepository('AppBundle:MenuFormules')->find($reservatieRegel->getFormuleId());
                if (null !== $menuFormule->getMenutypeId()) {
                    $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
                }
            }
            array_push($menuFormulesArray, $menuFormule);
        }
        $reservatie->setReservatieRegels($menuFormulesArray);

        /* Openingsuren in footer */
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/bevestiging.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
                    'reservatie' => $reservatie,
        ));
    }

    /**
     * @Route("/reservatie/send", name="send_mail")
     */
    public function sendAction(Request $request) {
        //echo($request->query->get('datum'));


        $message = \Swift_Message::newInstance()
                ->setSubject('Hello Email')
                ->setFrom('tseizoen@vdab.be')
                ->setTo('vincentvanlerberghe_73@hotmail.com')
                ->setBody(
                $this->renderView(
                        'email/bevestiging.html.twig', array('name' => "vincent", 'gegevens' => $gegevens)
                ), 'text/html'
        );
        $this->get('mailer')->send($message);

        //return $this->redirectToRoute('index', array(), 301);
    }

    /* --------------------------------VANAF HIER IS CRUD GENERATED------------------------------- */

    /**
     * Lists all Reservatie entities.
     *
     * @Route("/admin/reservatie/index", name="reservatie_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $reservaties = $em->getRepository('AppBundle:Reservatie')->findAll();

        $reservatiesArray = array();
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
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/index.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
                    'reservaties' => $reservaties,
        ));
    }

    /**
     * Creates a new Reservatie entity.
     *
     * @Route("/admin/reservatie/new", name="reservatie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $reservatie = new Reservatie();
        $defaultData = array('message' => 'my message');
        //$form = $this->createForm('AppBundle\Form\ReservatieType', $reservatie);
        $form = $this->createFormBuilder($defaultData)
                ->add('datum', 'date', array(
                    'attr' => array('class' => 'datepicker'),
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Datum'
                        )
                )
                ->add('naam', TextType::class, array(
                    'required' => true,
                    'label' => 'Naam'
                        )
                )
                ->add('email', EmailType::class, array(
                    'required' => false,
                    'label' => 'Email'
                        )
                )
                ->add('telefoon', TextType::class, array(
                    'required' => false,
                    'label' => 'Telefoon'
                        )
                )
                ->add('opdrachtgever', TextType::class, array(
                    'required' => false,
                    'label' => 'Opdrachtgever'
                        )
                )
                ->add('aantalDeelnemers', TextType::class, array(
                    'required' => true,
                    'label' => 'Aantal deelnemers'
                        )
                )
                ->add('aanvang', 'time', array(
                    'attr' => array('class' => 'timepicker'),
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Aankomstuur',
                    //'input' => 'datetime',
                    'widget' => 'single_text',
                    'required' => true,
                    'label' => 'Aankomstuur',
                        )
                )
                ->add('commentaar', TextareaType::class, array(
                    'required' => false
                        )
                )
                ->add('afdeling', TextType::class, array(
                    'required' => false,
                    'label' => 'Afdeling'
                        )
                )
                ->add('product', TextType::class, array(
                    'required' => false,
                    'label' => 'Product'
                        )
                )
                ->add('project', TextType::class, array(
                    'required' => false,
                    'label' => 'Project'
                        )
                )
                ->add('rekening', TextType::class, array(
                    'required' => false,
                    'label' => 'Rekening'
                        )
                )
                ->getForm();

        $form->handleRequest($request);

        $menuTypes = $em->getRepository('AppBundle:MenuType')->findAll();
        $menuFormules = $em->getRepository('AppBundle:MenuFormules')->findAll();

        $menuFormulesArray = array();
        foreach ($menuFormules as $menuFormule) {
            $menuFormule->setMenuType($em->getRepository('AppBundle:MenuType')->find($menuFormule->getMenutypeId()));
            array_push($menuFormulesArray, $menuFormule);
        }
        $menuFormules = $menuFormulesArray;

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($_POST['form']) && isset($_POST['reservatie'])) {

                $reservatie
                        ->setDatum(new \DateTime($_POST['form']['datum']))
                        ->setNaam($_POST['form']['naam'])
                        ->setEmail($_POST['form']['email'])
                        ->setTelefoon($_POST['form']['telefoon'])
                        ->setOpdrachtgever($_POST['form']['opdrachtgever'])
                        ->setAantalDeelnemers(intval($_POST['form']['aantalDeelnemers']))
                        ->setAanvang(new \DateTime($_POST['form']['aanvang']))
                        //  ->setEinde(new \DateTime($_POST['form']['einde']))
                        //  ->setTotaal($_POST['form']['totaal'])
                        ->setCommentaar($_POST['form']['commentaar'])
                        ->setAfdeling($_POST['form']['afdeling'])
                        ->setProduct($_POST['form']['product'])
                        ->setProject($_POST['form']['project'])
                        ->setRekening($_POST['form']['rekening']);

                $em->persist($reservatie);
                $em->flush();

                if ($reservatie->getId() > 0) {

                    foreach ($_POST['reservatie'] as $key => $value) {

                        $reservatieRegel = new ReservatieRegels();

                        $reservatieRegel
                                ->setReservatieId($reservatie->getId())
                                ->setFormuleId($value);

                        $em->persist($reservatieRegel);
                        $em->flush();
                    }
                }
            }

            return $this->redirectToRoute('reservatie_overzicht');
        }

        /* Openingsuren in footer */
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/new.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
                    'reservatie' => $reservatie,
                    'form' => $form->createView(),
                    'menutypes' => $menuTypes,
                    'menuformules' => $menuFormules,
        ));
    }

    /**
     * @Route("/admin/reservatie/newMenuFormule", name="reservatie_newMenuFormule")
     */
    public function newMenuFormule() {
        
    }

    /**
     * Finds and displays a Reservatie entity.
     *
     * @Route("/reservatie/{id}", name="reservatie_show")
     * @Method("GET")
     */
    /* wordt niet gebruikt */
    public function showAction(Reservatie $reservatie) {
        $deleteForm = $this->createDeleteForm($reservatie);

        return $this->render('reservatie/show.html.twig', array(
                    'reservatie' => $reservatie,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reservatie entity.
     *
     * @Route("/admin/reservatie/{id}/edit", name="reservatie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reservatie $reservatie) {
        $deleteForm = $this->createDeleteForm($reservatie);
        $editForm = $this->createForm('AppBundle\Form\ReservatieType', $reservatie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservatie);
            $em->flush();

            return $this->redirectToRoute('reservatie_edit', array('id' => $reservatie->getId()));
        }

        /* Openingsuren in footer */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('reservatie/edit.html.twig', array(
                    'reservatie' => $reservatie,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'openingsuren' => $openingsuren,
                    'user' => $this->getUser(),
        ));
    }

    /**
     * Deletes a Reservatie entity.
     *
     * @Route("reservatie//{id}", name="reservatie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reservatie $reservatie) {
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
    private function createDeleteForm(Reservatie $reservatie) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('reservatie_delete', array('id' => $reservatie->getId())))
                        ->setMethod('DELETE')
                        ->getForm();
    }

}
