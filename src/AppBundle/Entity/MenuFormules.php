<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 31/03/2016
 * Time: 11:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\MenuType;

/**
 * Class MenuFormules
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MenuFormulesRepository")
 * @ORM\Table(name="menuformules")
 */
class MenuFormules
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
     * @ORM\Column(type="text", length=255, nullable=true, name="info")
     */
    protected $info;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false, name="price" )
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(value=0)
     */
    protected $price;
    /**
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true, name="min_persons")
     */
    protected $minPersons;
    /**
     * @ORM\Column(type="decimal", precision=3, scale=0, nullable=true, name="max_persons")
     */
    protected $maxPersons;
    /**
     * @ORM\Column(type="integer", name="menutype_id")
     */
    protected $menutypeId;

    protected $menuType;

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
     * @return MenuFormules
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
     * Set info
     *
     * @param string $info
     * @return MenuFormules
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return MenuFormules
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set minPersons
     *
     * @param string $minPersons
     * @return MenuFormules
     */
    public function setMinPersons($minPersons)
    {
        $this->minPersons = $minPersons;

        return $this;
    }

    /**
     * Get minPersons
     *
     * @return string 
     */
    public function getMinPersons()
    {
        return $this->minPersons;
    }

    /**
     * Set maxPersons
     *
     * @param string $maxPersons
     * @return MenuFormules
     */
    public function setMaxPersons($maxPersons)
    {
        $this->maxPersons = $maxPersons;

        return $this;
    }

    /**
     * Get maxPersons
     *
     * @return string 
     */
    public function getMaxPersons()
    {
        return $this->maxPersons;
    }

    /**
     * Set menutypeId
     *
     * @param integer $menutypeId
     * @return MenuFormules
     */
    public function setMenutypeId($menutypeId)
    {
        $this->menutypeId = $menutypeId;

        return $this;
    }

    /**
     * Get menutypeId
     *
     * @return integer
     */
    public function getMenutypeId()
    {
        return $this->menutypeId;
    }

    /**
     * set menuType
     *
     * @param MenuType $menuType
     * @return MenuFormules
     */
    public function setMenuType(MenuType $menuType = null)
    {
        $this->menuType = $menuType;

        return $this;
    }

    /**
     * get menuType
     *
     * @return MenuType
     */
    public function getMenuType()
    {
        return $this->menuType;
    }
}
