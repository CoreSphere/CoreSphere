<?php

namespace CoreSphere\CoreBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;


class ExceptionController extends BaseController
{

    protected function findTemplate($templating, $format, $code, $debug)
    {
        $name = $debug ? 'exception' : 'error';
        if ($debug && 'html' == $format) {
            $name = 'exception_full';
        }

        // when not in debug, try to find a template for the specific HTTP status code and format
        if (!$debug) {
            $template = new TemplateReference('CoreSphereCoreBundle', 'Exception', $name.$code, $format, 'twig');
            if ($templating->exists($template)) {
                return $template;
            }
        }

        // try to find a template for the given format
        $template = new TemplateReference('CoreSphereCoreBundle', 'Exception', $name, $format, 'twig');
        if ($templating->exists($template)) {
            return $template;
        }

        // default to a generic HTML exception
        $this->container->get('request')->setRequestFormat('html');

        return new TemplateReference('CoreSphereCoreBundle', 'Exception', $name, 'html', 'twig');
    }

}