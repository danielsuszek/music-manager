<?php

namespace MusicManager\ManageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MusicManager\ManageBundle\Entity\Song;
use MusicManager\ManageBundle\Form\SongType;

/**
 * Song controller.
 *
 */
class SongController extends Controller
{

    /**
     * Lists all Song entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MusicManagerManageBundle:Song')->findAll();

        return $this->render('MusicManagerManageBundle:Song:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Song entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Song();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('song_show', array('id' => $entity->getId())));
        }

        return $this->render('MusicManagerManageBundle:Song:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Song entity.
     *
     * @param Song $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Song $entity)
    {
        $form = $this->createForm(new SongType(), $entity, array(
            'action' => $this->generateUrl('song_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Song entity.
     *
     */
    public function newAction()
    {
        $entity = new Song();
        $form   = $this->createCreateForm($entity);

        return $this->render('MusicManagerManageBundle:Song:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Song entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MusicManagerManageBundle:Song:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Song entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MusicManagerManageBundle:Song:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Song entity.
    *
    * @param Song $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Song $entity)
    {
        $form = $this->createForm(new SongType(), $entity, array(
            'action' => $this->generateUrl('song_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Song entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('song_edit', array('id' => $id)));
        }

        return $this->render('MusicManagerManageBundle:Song:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Song entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MusicManagerManageBundle:Song')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Song entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('song'));
    }

    /**
     * Creates a form to delete a Song entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('song_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
