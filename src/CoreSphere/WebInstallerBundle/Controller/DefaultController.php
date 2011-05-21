<?php

namespace CoreSphere\WebInstallerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreSphereWebInstallerBundle:Default:index.html.twig');
    }
}
