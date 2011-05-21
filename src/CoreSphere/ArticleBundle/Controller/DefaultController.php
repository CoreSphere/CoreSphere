<?php

namespace CoreSphere\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CoreSphereArticleBundle:Default:index.html.twig');
    }
}
