<?php

namespace CoreSphere\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreSphereCoreBundle:Default:index.html.twig');
    }
}
