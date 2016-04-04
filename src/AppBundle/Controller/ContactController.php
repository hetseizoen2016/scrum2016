<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Enquiry;
use AppBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ContactController extends Controller{

	/**
	* @Route("/contact", name="contact")
	*/
	public function contactAction(){

		/* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();
        
        return $this->render('contact/contact.html.twig', array(
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
	}
    
    /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*
             * As the Swift Mailer library does not use namespaces, we need
             * to prefix the Swift Mailer class with a \. This tells PHP to
             * escape back to the global space.
             */
            $message = \Swift_Message::newInstance()
                ->setSubject('Hello')
                ->setFrom('seizoen@vdab.be')
                ->setTo('geert@geertvanpoucke.be')
                ->setBody(
                    $this->renderView(
                        'contact/contactEmail.txt.twig',
                        array('enquiry' => $enquiry)
                    ),
                    'text/html'
                );
            
            $this->get('mailer')->send($message);

            //$this->get('session')->getFlashBag()->add('sendmail-notice', 'Uw bericht werd verzonden!');
            $this->addFlash('notice', 'Uw bericht werd verzonden!');
            
            return $this->redirectToRoute('test');
        }

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('contact/test.html.twig', array(
            'form' => $form->createView(),
            'openingsuren' => $openingsuren,
            'user' => $this->getUser(),
        ));
    }
}