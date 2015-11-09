<?php

namespace Instasaver\UserEnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InstasaverUserEnBundle:Default:index.html.twig', array('name' => $name));
    }
}
