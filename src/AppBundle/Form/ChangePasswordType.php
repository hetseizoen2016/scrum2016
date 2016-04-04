<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', 'password', array('label' => 'Huidig Wachtwoord'))
                ->add('newPassword', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'De wachtwoordvelden komen niet overeen',
            'required' => true,
            'first_options'  => array('label' => 'Nieuw wachtwoord'),
            'second_options' => array('label' => 'Herhaal nieuw wachtwoord'),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Model\ChangePassword',
        ));
    }

    public function getName()
    {
        return 'change_password';
    }
}
