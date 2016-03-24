<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Alias;
use QuapeeBundle\Form\AliasType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/alias")
 */
class AliasController extends Controller
{
    /**
     * @Route("/create")
     * @Template("QuapeeBundle:Alias:create.html.twig")
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

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/update/{id}")
     * @ParamConverter("alias", class="QuapeeBundle:Alias")
     * @Template("QuapeeBundle:Alias:update.html.twig")
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

        return [
            'form'  => $form->createView(),
            'alias' => $alias,
        ];
    }

    /**
     * @Route("/delete/{id}")
     * @Method({"POST"})
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
     * @Route("/double/{id}")
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
