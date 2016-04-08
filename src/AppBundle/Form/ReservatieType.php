<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservatieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datum', 'date', array('attr' => array('class' => 'datepicker'), 'widget' => 'single_text'))
            ->add('naam')
            ->add('opdrachtgever')
            ->add('aantalDeelnemers')
            ->add('aanvang', 'time', array('widget' => 'single_text'))
            ->add('commentaar', 'textarea')
            ->add('afdeling')
            ->add('product')
            ->add('project')
            ->add('rekening')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reservatie'
        ));
    }
}
