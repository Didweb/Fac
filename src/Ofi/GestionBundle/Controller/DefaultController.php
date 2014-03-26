<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OfiGestionBundle:Default:index.html.twig', array('name' => $name));
    }
}
