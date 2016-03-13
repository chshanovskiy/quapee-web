<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Frontend;
use QuapeeBundle\Form\FrontendType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontendController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/frontend/create", name="frontend_create")
     */
    public function createAction(Request $request)
    {
        $frontend = new Frontend();

        $form = $this->createForm(FrontendType::class, $frontend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frontend);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Frontend:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \QuapeeBundle\Entity\Frontend $frontend
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/frontend/update/{id}", name="frontend_update")
     * @ParamConverter("frontend", class="QuapeeBundle:Frontend")
     */
    public function updateAction(Request $request, Frontend $frontend)
    {
        $form = $this->createForm(FrontendType::class, $frontend);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($frontend);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Frontend:update.html.twig',
            [
                'form' => $form->createView(),
                'frontend' => $frontend,
            ]
        );
    }

}
