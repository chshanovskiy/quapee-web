<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Credential;
use QuapeeBundle\Form\CredentialType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/credential")
 */
class CredentialController extends Controller
{
    /**
     * @Route("/create")
     * @Template("QuapeeBundle:Credential:create.html.twig")
     */
    public function createAction(Request $request)
    {
        $credential = new Credential();

        $form = $this->createForm(CredentialType::class, $credential);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($credential);
            $em->flush();

            $message = sprintf('Credential "%s" successfully created.', $credential->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

            return $this->redirectToRoute('quapee');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/update/{id}")
     * @ParamConverter("credential", class="QuapeeBundle:Credential")
     * @Template("QuapeeBundle:Credential:update.html.twig")
     */
    public function updateAction(Request $request, Credential $credential)
    {
        $form = $this->createForm(CredentialType::class, $credential);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($credential);
            $em->flush();

            $message = sprintf('Credential "%s" successfully updated.', $credential->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

            return $this->redirectToRoute('quapee');
        }

        return [
            'form'       => $form->createView(),
            'credential' => $credential,
        ];
    }

}
