<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Frontend;
use QuapeeBundle\Form\FrontendType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/frontend")
 */
class FrontendController extends Controller
{
    /**
     * @param Request $request
     * @return array|RedirectResponse
     *
     * @Route("/create")
     * @Template("QuapeeBundle:Frontend:create.html.twig")
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

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @param Request  $request
     * @param Frontend $frontend
     * @return array|RedirectResponse
     *
     * @Route("/update/{id}")
     * @ParamConverter("frontend", class="QuapeeBundle:Frontend")
     * @Template("QuapeeBundle:Frontend:update.html.twig")
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

        return [
            'form'     => $form->createView(),
            'frontend' => $frontend,
        ];
    }
}
