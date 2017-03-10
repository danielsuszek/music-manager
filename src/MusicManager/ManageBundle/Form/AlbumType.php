<?php

namespace MusicManager\ManageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use MusicManager\ManageBundle\Entity\Band;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('released');
        $builder->add('rate', 'choice',  array('choices'=> array(
            '1' => 1, '2' => 2, '3' => 3, '4' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10)));
        
        $band = new Band();
        
        
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
