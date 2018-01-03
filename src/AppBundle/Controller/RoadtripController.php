<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Roadtrip;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Roadtrip controller.
 *
 * @Route("roadtrip")
 */
class RoadtripController extends Controller
{
    /**
     * Lists all roadtrip entities.
     *
     * @Route("/", name="roadtrip_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roadtrips = $em->getRepository('AppBundle:Roadtrip')->findAll();

        return $this->render('AppBundle:roadtrip:index.html.twig', array(
            'roadtrips' => $roadtrips,
        ));
    }

    /**
     * Creates a new roadtrip entity.
     *
     * @Route("/new", name="roadtrip_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $roadtrip = new Roadtrip();
        $form = $this->createForm('AppBundle\Form\RoadtripType', $roadtrip, array('action' => $this->generateUrl('roadtrip_new')));

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if(!$form->isValid()) {
                $errors = [];

                if ($form->count() > 0) {
                    foreach ($form->all() as $child) {
                        /**
                         * @var \Symfony\Component\Form\Form $child
                         */
                        if (!$child->isValid()) {
                            $errors[$child->getName()] = $this->getErrorMessages($child);
                        }
                    }
                }
                /**
                 * @var \Symfony\Component\Form\FormError $error
                 */
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }
                dump($errors);
            }
            else {
                //dump($request->request->all());die;
                $roadtrip->setIsRemoved(false);
                $em->persist($roadtrip);
                $em->flush();

                return $this->redirectToRoute('roadtrip_show', array('slug' => $roadtrip->getSlug()));
            }
        }

        return $this->render('AppBundle:roadtrip:new.html.twig', array(
            'roadtrip' => $roadtrip,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a roadtrip entity.
     *
     * @Route("/{slug}", name="roadtrip_show")
     * @Method("GET")
     */
    public function showAction(Roadtrip $roadtrip)
    {
        $deleteForm = $this->createDeleteForm($roadtrip);

        return $this->render('AppBundle:roadtrip:show.html.twig', array(
            'roadtrip' => $roadtrip,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing roadtrip entity.
     *
     * @Route("/{slug}/edit", name="roadtrip_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Roadtrip $roadtrip)
    {
        $deleteForm = $this->createDeleteForm($roadtrip);
        $editForm = $this->createForm('AppBundle\Form\RoadtripType', $roadtrip);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('roadtrip_edit', array('slug' => $roadtrip->getSlug()));
        }

        return $this->render('AppBundle:roadtrip:edit.html.twig', array(
            'roadtrip' => $roadtrip,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a roadtrip entity.
     *
     * @Route("/{slug}", name="roadtrip_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Roadtrip $roadtrip)
    {
        $form = $this->createDeleteForm($roadtrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($roadtrip);
            $em->flush();
        }

        return $this->redirectToRoute('roadtrip_index');
    }

    /**
     * Creates a form to delete a roadtrip entity.
     *
     * @param Roadtrip $roadtrip The roadtrip entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Roadtrip $roadtrip)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('roadtrip_delete', array('slug' => $roadtrip->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
