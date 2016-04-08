<?php 

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use AppBundle\Entity\ReservatieType;

/**
* Class Reservatie
* @package AppBundle\Entity
* @ORM\Entity(repositoryClass="AppBundle\Entity\ReservatieRepository")
* @ORM\Entity
* @ORM\Table(name="reservatie")
*/
class Reservatie{

	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="date")
	*/
	protected $datum;

	/**
	* @ORM\Column(type="string", length=255)
	*/
	protected $naam;
	/**
	* @ORM\Column(type="string", length=255, nullable=true)
	*/
	protected $opdrachtgever;
	/**
	* @ORM\Column(type="integer", name="aantal_deelnemers")
	*/
	protected $aantalDeelnemers;
	/**
	* @ORM\Column(type="time")
	*/
	protected $aanvang;
	/**
	* @ORM\Column(type="time", nullable=true)
	*/
	protected $einde;
	/**
     * @ORM\Column(type="decimal", precision=8, scale=2)
     */
	protected $totaal;
    /**
    * @ORM\Column(type="text", length=1028, nullable=true)
    */

    protected $reservatieRegels;

	protected $commentaar;
    /**
    * @ORM\Column(type="string", nullable=true)
    */
	protected $afdeling;
    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
	protected $product;
    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
	protected $project;
    /**
    * @ORM\Column(type="string", length=255, nullable=true)
    */
	protected $rekening;

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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Reservatie
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set naam
     *
     * @param string $naam
     * @return Reservatie
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string 
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set opdrachtgever
     *
     * @param string $opdrachtgever
     * @return Reservatie
     */
    public function setOpdrachtgever($opdrachtgever)
    {
        $this->opdrachtgever = $opdrachtgever;

        return $this;
    }

    /**
     * Get opdrachtgever
     *
     * @return string 
     */
    public function getOpdrachtgever()
    {
        return $this->opdrachtgever;
    }

    /**
     * Set aantalDeelnemers
     *
     * @param integer $aantalDeelnemers
     * @return Reservatie
     */
    public function setAantalDeelnemers($aantalDeelnemers)
    {
        $this->aantalDeelnemers = $aantalDeelnemers;

        return $this;
    }

    /**
     * Get aantalDeelnemers
     *
     * @return integer 
     */
    public function getAantalDeelnemers()
    {
        return $this->aantalDeelnemers;
    }

    /**
     * Set aanvang
     *
     * @param \DateTime $aanvang
     * @return Reservatie
     */
    public function setAanvang($aanvang)
    {
        $this->aanvang = $aanvang;

        return $this;
    }

    /**
     * Get aanvang
     *
     * @return \DateTime 
     */
    public function getAanvang()
    {
        return $this->aanvang;
    }

    /**
     * Set einde
     *
     * @param \DateTime $einde
     * @return Reservatie
     */
    public function setEinde($einde)
    {
        $this->einde = $einde;

        return $this;
    }

    /**
     * Get einde
     *
     * @return \DateTime 
     */
    public function getEinde()
    {
        return $this->einde;
    }

    /**
     * Set totaal
     *
     * @param string $totaal
     * @return Reservatie
     */
    public function setTotaal($totaal)
    {
        $this->totaal = $totaal;

        return $this;
    }

    /**
     * Get totaal
     *
     * @return string 
     */
    public function getTotaal()
    {
        return $this->totaal;
    }

    /**
     * Set commentaar
     *
     * @param string $commentaar
     * @return Reservatie
     */
    public function setCommentaar($commentaar)
    {
        $this->commentaar = $commentaar;

        return $this;
    }

    /**
     * Get commentaar
     *
     * @return string 
     */
    public function getCommentaar()
    {
        return $this->commentaar;
    }

    /**
     * Set afdeling
     *
     * @param string $afdeling
     * @return Reservatie
     */
    public function setAfdeling($afdeling)
    {
        $this->afdeling = $afdeling;

        return $this;
    }

    /**
     * Get afdeling
     *
     * @return string 
     */
    public function getAfdeling()
    {
        return $this->afdeling;
    }

    /**
     * Set product
     *
     * @param string $product
     * @return Reservatie
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return string 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set project
     *
     * @param string $project
     * @return Reservatie
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set rekening
     *
     * @param string $rekening
     * @return Reservatie
     */
    public function setRekening($rekening)
    {
        $this->rekening = $rekening;

        return $this;
    }

    /**
     * Get rekening
     *
     * @return string 
     */
    public function getRekening()
    {
        return $this->rekening;
    }

    /**
     * Set reservatieRegels
     *
     * @param array $reservatieRegels
     * @return Reservatie
     */
    public function setReservatieRegels($reservatieRegels)
    {
        $this->reservatieRegels = $reservatieRegels;

        return $this;
    }

    /**
     * Get reservatieRegels
     *
     * @return array 
     */
    public function getReservatieRegels()
    {
        return $this->reservatieRegels;
    }

}
