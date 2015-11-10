<?php

namespace Instasaver\UserEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class TestController extends Controller {
	protected $router;
	public function indexAction() {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$userId = $user->getId();
		$response = new RedirectResponse('id'.$userId);
		return $response;
		/*$user = $this->get('security.token_storage')->getToken()->getUser();
		$userId = $user->getId();
		$repository = $this->getDoctrine()->getRepository('InstasaverIndexEnBundle:User');
		$user = $repository->find($userId);
		if (!$user) {
			throw $this->createNotFoundException('No user found for id '.$userId);
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
		"SELECT username FROM InstasaverIndexEnBundle:User username WHERE username.id = $userId"
		);
		$username = $query->getResult();
		return new Response('Hello, '.$username[0]->getUsername());*/
	}
}