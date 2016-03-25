<?php

namespace QuapeeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @return RedirectResponse
     *
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('quapee');
    }
}
