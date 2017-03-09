<?php

namespace MusicManager\ManageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('released')
            ->add('description')
            ->add('rate')
            ->add('sleevePicUrl')
            ->add('save', 'submit', array('label' => 'Dodaj album'));
//            ->add('name')
//            ->add('released', 'integer')
//            ->add('description')
//            ->add('rate', 'integer')
//            ->add('sleevePicUrl')
//            ->add('save', 'submit', array('label' => 'Dodaj album'));
    }
    
    public function getName()
    {
        return 'album';
    }
}
