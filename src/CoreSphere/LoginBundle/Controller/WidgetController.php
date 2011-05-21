<?php

namespace CoreSphere\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class WidgetController extends Controller
{

    public function statusAction($style = 'simple')
    {
		$user = $this->container->get('security.context')->getToken()->getUser();

		return $this->render('CoreSphereLoginBundle:Widget:'.$style.'_status.html.twig', array(
			'user' => $user,
		));
    }

}
