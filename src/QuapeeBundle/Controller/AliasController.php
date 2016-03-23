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

            $message = sprintf('Alias "%s" successfully created.', $alias->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

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

            $message = sprintf('Alias "%s" successfully updated.', $alias->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

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

    /**
     * @param \QuapeeBundle\Entity\Alias $alias
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alias/delete/{id}", name="alias_delete")
     * @ParamConverter("alias", class="QuapeeBundle:Alias")
     */
    public function deleteAction(Alias $alias)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($alias);
        $em->flush();

        $message = sprintf('Alias "%s" successfully deleted.', $alias->getTitle());
        $this->get('session')->getFlashBag()->add('alert', $message);

        return $this->redirectToRoute('quapee');
    }

    /**
     * @param \QuapeeBundle\Entity\Alias $alias
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/alias/double/{id}", name="alias_double")
     * @ParamConverter("alias", class="QuapeeBundle:Alias")
     */
    public function doubleAction(Alias $alias)
    {
        $em = $this->getDoctrine()->getManager();

        $double = clone $alias;

        $title = sprintf('%s_%.6s', $double->getTitle(), uniqid('', true));
        $double->setTitle($title);

        $em->persist($double);
        $em->flush();

        $message = sprintf('Alias "%s" successfully duplicated.', $alias->getTitle());
        $this->get('session')->getFlashBag()->add('alert', $message);

        return $this->redirectToRoute('quapee');
    }
}
