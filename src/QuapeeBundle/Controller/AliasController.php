<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Alias;
use QuapeeBundle\Form\AliasType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AliasController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alias/create", name="alias_create")
     */
    public function createAction(Request $request)
    {
        $alias = new Alias();

        $form = $this->createForm(AliasType::class, $alias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alias);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Alias:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \QuapeeBundle\Entity\Alias $alias
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alias/update/{id}", name="alias_update")
     * @ParamConverter("alias", class="QuapeeBundle:Alias")
     */
    public function updateAction(Request $request, Alias $alias)
    {
        $form = $this->createForm(AliasType::class, $alias);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($alias);
            $em->flush();

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Alias:update.html.twig',
            [
                'form' => $form->createView(),
                'alias' => $alias,
            ]
        );
    }

}
