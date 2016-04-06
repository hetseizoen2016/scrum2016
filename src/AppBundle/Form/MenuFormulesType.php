<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MenuFormulesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('info', TextareaType::class)
            ->add('price', MoneyType::class)
            ->add('minPersons', IntegerType::class,
                array(
                    'required' => false,
                ))
            ->add('maxPersons', IntegerType::class,
                array(
                    'required' => false,
                ))
            ->add('menutype', EntityType::class,
                array(
                    'class' => 'AppBundle:MenuType',
                    'choice_label' => 'name',
            //        'required' => false,
            //        'placeholder' => '--- kies een menu type ---',
                    'label' => 'Menu type'
                ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MenuFormules'
        ));
    }
}
