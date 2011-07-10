<?php

namespace CoreSphere\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CoreSphere\StaticBundle\Entity\Page;
use CoreSphere\StaticBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
    /**
     * Lists all Page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreSphereStaticBundle:Page')->findAll();

        return $this->render('CoreSphereStaticBundle:Page:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($permalink)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreSphereStaticBundle:Page')->findOneByPermalink($permalink);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($permalink);

        return $this->render('CoreSphereStaticBundle:Page:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction()
    {
        $entity = new Page();
        $form   = $this->createForm(new PageType(), $entity);

        return $this->render('CoreSphereStaticBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Page entity.
     *
     */
    public function createAction()
    {
        $entity  = new Page();
        $request = $this->getRequest();
        $form    = $this->createForm(new PageType(), $entity);

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('page_show', array('permalink' => $entity -> getPermalink())));
                
            }
        }

        return $this->render('CoreSphereStaticBundle:Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($permalink)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreSphereStaticBundle:Page')->findOneByPermalink($permalink);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createForm(new PageType(), $entity);
        $deleteForm = $this->createDeleteForm($permalink);

        return $this->render('CoreSphereStaticBundle:Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Page entity.
     *
     */
    public function updateAction($permalink)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreSphereStaticBundle:Page')->findOneByPermalink($permalink);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm   = $this->createForm(new PageType(), $entity);
        $deleteForm = $this->createDeleteForm($permalink);

        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('page_edit', array('permalink' => $entity -> getPermalink())));
            }
        }

        return $this->render('CoreSphereStaticBundle:Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction($permalink)
    {
        $form = $this->createDeleteForm($permalink);
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $entity = $em->getRepository('CoreSphereStaticBundle:Page')->findOneByPermalink($permalink);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find Page entity.');
                }

                $em->remove($entity);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('page'));
    }

    private function createDeleteForm($permalink)
    {
        return $this->createFormBuilder(array('permalink' => $permalink))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
