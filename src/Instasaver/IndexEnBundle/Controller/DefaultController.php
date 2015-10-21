<?php

namespace Instasaver\IndexEnBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('InstasaverIndexEnBundle:Default:index.html.twig', array('name' => $name));
    }
}
