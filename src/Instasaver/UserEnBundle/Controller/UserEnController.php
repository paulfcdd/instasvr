<?php

namespace Instasaver\UserEnBundle\Controller;
use Instasaver\IndexEnBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserEnController extends Controller {
	
	public function indexAction($id_num) {
		
		$repository = $this->getDoctrine()->getRepository('InstasaverIndexEnBundle:User');
		$user = $repository->find($id_num);
		if (!$user) {
			throw $this->createNotFoundException('No user found for id '.$id_num);
		}
		
		$em = $this->getDoctrine()->getEntityManager();
		$query = $em->createQuery(
		"SELECT username FROM InstasaverIndexEnBundle:User username WHERE username.id = $id_num"
		);
		$username = $query->getResult();
		return new Response('Hello, '.$username[0]->getUsername());
	}
	
}