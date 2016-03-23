<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Service;
use QuapeeBundle\Form\ServiceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/service/create", name="service_create")
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

        return $this->render(
            'QuapeeBundle:Service:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \QuapeeBundle\Entity\Service $service
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/service/update/{id}", name="service_update")
     * @ParamConverter("service", class="QuapeeBundle:Service")
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

        return $this->render(
            'QuapeeBundle:Service:update.html.twig',
            [
                'form' => $form->createView(),
                'service' => $service,
            ]
        );
    }

}
