<?php

namespace QuapeeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/quapee", name="quapee")
     */
    public function indexAction()
    {
        $registry = $this->getDoctrine();
        $services = $registry->getRepository('QuapeeBundle:Service')
            ->findAll();
        $credentials = $registry->getRepository('QuapeeBundle:Credential')
            ->findAll();

        return $this->render(
            'QuapeeBundle:Home:index.html.twig',
            [
                'credentials' => $credentials,
                'services' => $services,
            ]
        );
    }

}
