<?php

namespace Instasaver\LoginEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\Register;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LoginEnController extends Controller {
	public function loginAction(Request $request) {
		$authenticationUtils = $this->get('security.authentication_utils');
		
		$error = $authenticationUtils->getLastAuthenticationError();
		
		$lastUsername = $authenticationUtils->getLastUsername();

    return $this->render(
        'security/login.html.twig',
        array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $error,
        )
    );
	}
	
	 public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
}