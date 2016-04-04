<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 1/04/2016
 * Time: 21:30
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EnquiryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email', 'email');
        $builder->add('subject');
        $builder->add('body', 'textarea');
    }
    /*
    public function getName()
    {
        return 'contact';
    }
    */
}