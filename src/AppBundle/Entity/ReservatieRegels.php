<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use AppBundle\Entity\ReservatieType;

/**
* Class ReservatieRegels
* @package AppBundle\Entity
* @ORM\Entity(repositoryClass="AppBundle\Entity\ReservatieRegelsRepository")
* @ORM\Entity
* @ORM\Table(name="reservatie_regels")
*/

class ReservatieRegels{
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="integer", name="reservatie_id")
	*/
	protected $reservatieId;

	/**
	* @ORM\Column(type="integer", name="formule_id")
	*/
	protected $formuleId;

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
     * Set reservatieId
     *
     * @param integer $reservatieId
     * @return ReservatieRegels
     */
    public function setReservatieId($reservatieId)
    {
        $this->reservatieId = $reservatieId;

        return $this;
    }

    /**
     * Get reservatieId
     *
     * @return integer 
     */
    public function getReservatieId()
    {
        return $this->reservatieId;
    }

    /**
     * Set formuleId
     *
     * @param integer $formuleId
     * @return ReservatieRegels
     */
    public function setFormuleId($formuleId)
    {
        $this->formuleId = $formuleId;

        return $this;
    }

    /**
     * Get formuleId
     *
     * @return integer 
     */
    public function getFormuleId()
    {
        return $this->formuleId;
    }
}
