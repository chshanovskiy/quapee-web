<?php

namespace QuapeeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/quapee", name="quapee")
     * @Template("QuapeeBundle:Home:index.html.twig")
     */
    public function quapeeAction()
    {
        $registry = $this->getDoctrine();
        $aliases = $registry->getRepository('QuapeeBundle:Alias')
            ->findAll();
        $frontends = $registry->getRepository('QuapeeBundle:Frontend')
            ->findAll();
        $services = $registry->getRepository('QuapeeBundle:Service')
            ->findAll();
        $credentials = $registry->getRepository('QuapeeBundle:Credential')
            ->findAll();

        return [
            'aliases'     => $aliases,
            'frontends'   => $frontends,
            'credentials' => $credentials,
            'services'    => $services,
        ];
    }
}
