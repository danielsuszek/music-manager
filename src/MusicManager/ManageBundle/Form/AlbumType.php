<?php

namespace MusicManager\ManageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use MusicManager\ManageBundle\Entity\Band;
use MusicManager\ManageBundle\Entity\Album;
use MusicManager\ManageBundle\Entity\Song;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('released');
        $builder->add('rate', 'choice',  array('choices'=> array(
            '1' => 1, '2' => 2, '3' => 3, '4' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10)));
        
        $builder->add('band', 'entity', [
            'class' => 'MusicManagerManageBundle:Band',
            'choice_label' => 'name',
            'choice_value' => 'id'
        ]
        );
        
        $builder->add('description');
        $builder->add('sleevePicUrl', 'text',['required' => false]);

        $builder->add('songs', 'collection', [
            'entry_type' => new SongType(),
            'allow_add'  => true,
            'by_reference' => false,
            ]
            
        );
        $builder->add('save', 'submit', array('label' => 'Dodaj album'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MusicManager\ManageBundle\Entity\Album'
        ));
    }
    
    public function getName()
    {
        return 'album';
    }
}
