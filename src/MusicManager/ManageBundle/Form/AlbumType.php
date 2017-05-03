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
        
        $prepend = range(1900, 2050);
//        make array (int)1900 => (int)1900, ... ,(int)2050 => (int)2050
        $released = array_combine(array_values($prepend), $prepend);
        $builder->add('released', 'choice',[
                        'choices' => $released, 
                        'placeholder' => '-wybierz-',
                        'required'    => false
                        ]);
        
        
        $prepend = range(1, 10);
//      keys start from 1 and not from 0
        $rate = array_combine(array_values($prepend), $prepend);
        $builder->add('rate', 'choice', [
                        'choices' => $rate,
                        'placeholder' => '-wybierz-'
                        ]);

        $builder->add('band', 'entity', [
            'class' => 'MusicManagerManageBundle:Band',
            'choice_label' => 'name',
            'choice_value' => 'id'
        ]);
        
        $builder->add('description', 'text', ['required' => false]);

        $builder->add('sleevePicUrl', 'file',[
                          'attr' => ['accept' => '.png,.jpg,.jpeg'],
                          'data_class' => null
                      ]);

        $builder->add('songs', 'collection', [
            'entry_type' => new SongType(),
            'allow_add'  => true,
            'by_reference' => false,
            ]);
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
