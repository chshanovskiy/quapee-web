<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Service;
use QuapeeBundle\Form\ServiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/service")
 */
class ServiceController extends Controller
{
    /**
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/create")
     * @Template("QuapeeBundle:Service:create.html.twig")
     */
    public function createAction(Request $request)
    {
        $service = new Service();

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request $request
     * @param Service $service
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/update/{id}")
     * @ParamConverter("service", class="QuapeeBundle:Service")
     * @Template("QuapeeBundle:Service:update.html.twig")
     */
    public function updateAction(Request $request, Service $service)
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return [
            'form'    => $form->createView(),
            'service' => $service,
        ];
    }
}
