<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 5/04/2016
 * Time: 11:56
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class MenuType
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MenuTypeRepository")
 * @ORM\Table(name="menutypes")
 */
class MenuType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=64, nullable=false, name="name")
     * @Assert\NotBlank()
     */
    protected $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MenuType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
