<?php
/**
 * Created by PhpStorm.
 * User: Geert
 * Date: 29/03/2016
 * Time: 18:56
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Openingsuur
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\OpeningsuurRepository")
 * @ORM\Table(name="openingsuren")
 */

class Openingsuur
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $dag;
    /**
     * @ORM\Column(type="time", nullable=true)
     */
    protected $van;
    /**
     * @ORM\Column(type="time", nullable=true)
     */
    protected $tot;


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
     * Set dag
     *
     * @param string $dag
     * @return Openingsuur
     */
    public function setDag($dag)
    {
        $this->dag = $dag;

        return $this;
    }

    /**
     * Get dag
     *
     * @return string 
     */
    public function getDag()
    {
        return $this->dag;
    }

    /**
     * Set van
     *
     * @param \DateTime $van
     * @return Openingsuur
     */
    public function setVan($van)
    {
        $this->van = $van;

        return $this;
    }

    /**
     * Get van
     *
     * @return \DateTime 
     */
    public function getVan()
    {
        return $this->van;
    }

    /**
     * Set tot
     *
     * @param \DateTime $tot
     * @return Openingsuur
     */
    public function setTot($tot)
    {
        $this->tot = $tot;

        return $this;
    }

    /**
     * Get tot
     *
     * @return \DateTime 
     */
    public function getTot()
    {
        return $this->tot;
    }
}
