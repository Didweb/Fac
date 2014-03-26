<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FijasController extends Controller
{
    public function indexAction()
    {
        return $this->render('OfiGestionBundle:Fijas:index.html.twig');
    }
}
