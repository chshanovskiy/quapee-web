<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Proxy\Core\Proxy;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * HomeController
 */
class HomeController extends Controller
{
    /**
     * @return array
     *
     * @Route("/quapee", name="quapee")
     * @Template("QuapeeBundle:Home:index.html.twig")
     */
    public function quapeeAction()
    {
        $registry = $this->getDoctrine();
        $aliases = $registry->getRepository('QuapeeBundle:Alias')->findAll();
        $frontends = $registry->getRepository('QuapeeBundle:Frontend')->findAll();
        $services = $registry->getRepository('QuapeeBundle:Service')->findAll();
        $credentials = $registry->getRepository('QuapeeBundle:Credential')->findAll();

        return [
            'aliases'     => $aliases,
            'frontends'   => $frontends,
            'credentials' => $credentials,
            'services'    => $services,
        ];
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/api", name="api")
     */
    public function apiAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $data = $this->get('quapee.proxy')->pass($json);

        $response = new Response($data->json());
        $response->setStatusCode($data->isSuccess() ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        $response->headers->set('Content-Type', 'application/json;charset=utf-8');

        return $response;
    }
}
