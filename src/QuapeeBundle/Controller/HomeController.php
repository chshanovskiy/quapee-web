<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Proxy\Core\Proxy;
use QuapeeBundle\Proxy\Core\RequestFactory;
use QuapeeBundle\Proxy\Core\RequestValidator;
use QuapeeBundle\Proxy\Impl\DatabaseServiceCredentialsRepository;
use QuapeeBundle\Proxy\Impl\SoapServiceFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/api", name="api")
     */
    public function apiAction(Request $request)
    {
        $proxy = new Proxy(
            new RequestFactory(
                new RequestValidator()
            ),
            new SoapServiceFactory(
                new DatabaseServiceCredentialsRepository(
                    $this->getDoctrine()->getConnection()
                )
            )
        );

        if (strpos($request->headers->get('Content-Type'), 'application/json') === false) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }

        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : []);

        $data = $proxy->pass($request->request->all());

        /* 271 = (JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) */
        $content = json_encode($data->extract(), 271);
        $status = $data->isSuccess()
            ? Response::HTTP_OK
            : Response::HTTP_BAD_REQUEST;

        $response = new Response($content, $status);
        $response->headers->set('Content-Type', 'application/json;charset=utf-8');

        return $response;
    }
}
