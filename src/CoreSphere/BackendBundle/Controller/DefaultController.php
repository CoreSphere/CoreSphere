<?php

namespace CoreSphere\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreSphereBackendBundle:Default:index.html.twig');
    }
}
