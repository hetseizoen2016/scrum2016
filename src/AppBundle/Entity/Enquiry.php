<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 1/04/2016
 * Time: 21:16
 */

namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Enquiry
{

    protected $name;

    protected $email;

    protected $subject;

    protected $body;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank(array(
            'message' => 'U moet een naam invullen!')));

        $metadata->addPropertyConstraint('email', new Email(array(
            'message' => 'U moet een geldig emailadres invullen!')));

        $metadata->addPropertyConstraint('subject', new NotBlank(array(
            'message' => 'U moet een onderwerp invullen!')));

        $metadata->addPropertyConstraint('subject', new Length(array(
            'max' => 50)));
        
        $metadata->addPropertyConstraint('body', new Length(array(
            'max' => 50)));
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        //return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        //return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        //return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        //return $this;

    }
}