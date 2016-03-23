<?php

namespace QuapeeBundle\Controller;

use QuapeeBundle\Entity\Credential;
use QuapeeBundle\Form\CredentialType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CredentialController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/credential/create", name="credential_create")
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

            $message = sprintf('Credential "%s" successfully created.', $alias->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Credential:create.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \QuapeeBundle\Entity\Credential $credential
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/credential/update/{id}", name="credential_update")
     * @ParamConverter("credential", class="QuapeeBundle:Credential")
     */
    public function updateAction(Request $request, Credential $credential)
    {
        $form = $this->createForm(CredentialType::class, $credential);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($credential);
            $em->flush();

            $message = sprintf('Credential "%s" successfully updated.', $alias->getTitle());
            $this->get('session')->getFlashBag()->add('alert', $message);

            return $this->redirectToRoute('quapee');
        }

        return $this->render(
            'QuapeeBundle:Credential:update.html.twig',
            [
                'form' => $form->createView(),
                'credential' => $credential,
            ]
        );
    }

}
