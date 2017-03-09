<?php

namespace MusicManager\ManageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('released');
//        $builder->add('released', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
//            'choices'  => array(
//                'Maybe' => null,
//                'Yes' => true,
//                'No' => false,
//            ),
//        ));
        $builder->add('rate');
        $builder->add('description');
        $builder->add('sleevePicUrl');
            
        $builder->add('save', 'submit', array('label' => 'Dodaj album'));
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
