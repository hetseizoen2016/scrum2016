<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Form\ChangePasswordType;
use AppBundle\Form\Model\ChangePassword;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {
        $session = new Session();

        if ($this->getUser()) {
            return $this->redirect($this->generateUrl('admin'));
        }

        /* Openingsuren */
        $em = $this->getDoctrine()->getManager();
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
                        'authenticatie/login.html.twig', array(
                    // last username entered by the user
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'openingsuren' => $openingsuren
                        )
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction() {
        
    }

    /**
     * @Route("/admin/password", name="password")
     */
    public function changePasswordAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();

        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(new ChangePasswordType(), $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passwordSubmit = $form->getData();
            $encodedPassword = password_hash($passwordSubmit->getNewPassword(), PASSWORD_BCRYPT);
            $user->setPassword($encodedPassword);
            $em->persist($user);
            $em->flush();
        }

        /* Openingsuren */
        
        $openingsuren = $em->getRepository('AppBundle:Openingsuur')->findAll();

        return $this->render('authenticatie/password.html.twig', array(
                    'openingsuren' => $openingsuren,
                    'form' => $form->createView()
        ));
    }

}
