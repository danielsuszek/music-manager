<?php

namespace MusicManager\ManageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArrayChoiceType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
//         $builder->add('name', 'choice', 
//                 ['choices' => $this->choices]
//                        );
         $builder->add('name', 'entity', 
                 [
                     'class' => 'MusicManagerManageBundle:Band',
                     'choice_label' => 'name',
                     'choice_value' => 'id'
                 ]
                        );
         $builder->add('description');
         $builder->add('save', 'submit', array('label' => 'Dodaj zespół'));
    }
    
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MusicManager\ManageBundle\Entity\Band'
        ));
    }

    
    public function getName()
    {
        return 'array_choice_type';
    }
}

