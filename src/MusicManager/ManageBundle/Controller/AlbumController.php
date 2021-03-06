<?php

namespace MusicManager\ManageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MusicManager\ManageBundle\Entity\Album;
use MusicManager\ManageBundle\Entity\Band;
use MusicManager\ManageBundle\Entity\Song;
use MusicManager\ManageBundle\Form\AlbumType;
use MusicManager\ManageBundle\Form\AlbumEditType;
use MusicManager\ManageBundle\Form\ArrayChoiceType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
/**
 * Album controller.
 *
 */
class AlbumController extends Controller
{
    /**
     * Lists all Album entities.
     *
     */
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $entities = $em->getRepository('MusicManagerManageBundle:Album')->findAll();
        
       $em = $this->getDoctrine()->getEntityManager();
       $entities = $em->getRepository('MusicManagerManageBundle:Album')
                    ->getNameOrdered();        
        
//        exit(\Doctrine\Common\Util\Debug::dump($entities));

        return $this->render('MusicManagerManageBundle:Album:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Album entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Album();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
//            exit(\Doctrine\Common\Util\Debug::dump($form->getData()));                        
            $file = $entity->getSleevePicUrl();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $entity->setSleevePicUrl($fileName);
            
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('album_show', array('id' => $entity->getId())));

        }
        
        return $this->render('MusicManagerManageBundle:Album:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
        
    }

    /**
     * Creates a form to create a Album entity.
     *
     * @param Album $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Album $entity)
    {
        $form = $this->createForm(new AlbumType(), $entity, array(
            'action' => $this->generateUrl('album_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', [
                                'label' => 'Dodaj album',
                                'attr' => [
                                    'class' => 'btn-primary'
                                    ]
        ]);
        
        return $form;
    }

    /**
     * Displays a form to create a new Album entity.
     *
     */
    public function newAction()
    {
        $entity = new Album();
        
        $song1 = new Song();
        $song1->setTitle('tyt1');
        $song1->setLength('02:33');
        $entity->getSongs()->add($song1);
        
        $song2 = new Song();
        $song2->setTitle('tyt2');
        $song2->setLength('03:40');
        $entity->getSongs()->add($song2);
        
        $form   = $this->createCreateForm($entity);

        
        return $this->render('MusicManagerManageBundle:Album:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));        
    }

    /**
     * Finds and displays a Album entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }
        
        $bandName = $entity->getBand()->getName();
//        exit(\Doctrine\Common\Util\Debug::dump($entity));
//        $deleteForm = $this->createDeleteForm($id);

//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('MusicManagerManageBundle:Album:show.html.twig', array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//        ));
        return $this->render('MusicManagerManageBundle:Album:show.html.twig', array(
            'entity'      => $entity
        ));
    }

    /**
     * Displays a form to edit an existing Album entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Album')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $form = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MusicManagerManageBundle:Album:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Album entity.
    *
    * @param Album $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Album $entity)
    {
        $form = $this->createForm(new AlbumEditType(), $entity, array(
            'action' => $this->generateUrl('album_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Album entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MusicManagerManageBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

//        exit(\Doctrine\Common\Util\Debug::dump($form));                    

        if ($form->isSubmitted() && $form->isValid()) {     
//        exit(\Doctrine\Common\Util\Debug::dump($entity));                    
            $em->flush();

            return $this->redirect($this->generateUrl('album_show', array('id' => $id)));
        }

        return $this->render('MusicManagerManageBundle:Album:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Album entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MusicManagerManageBundle:Album')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Album entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('album'));
    }

    /**
     * Creates a form to delete a Album entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                    'label' => 'Usuń album',
                    'attr'  => [
                            'onclick' => 'return confirm("Usunąć album?")',
                            'class'   => 'btn btn-danger'
                        ]
                ))
            ->getForm()
        ;
    }
}
