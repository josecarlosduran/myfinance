<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Cuenta;

/**
 * Subclase
 *
 * @ORM\Table(name="subclases")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubclaseRepository")
 */
class Subclase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;
	
	/**
	* @ORM\ManyToOne(targetEntity="Clase")
	*/
	private $clase;
	
	/**
	* @ORM\ManyToOne(targetEntity="Cuenta")
	*/
	private $cuenta;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="subclase")
	*/
	private $anotaciones;


   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anotaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Subclase
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set clase
     *
     * @param \AppBundle\Entity\Clase $clase
     *
     * @return Subclase
     */
    public function setClase(\AppBundle\Entity\Clase $clase = null)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return \AppBundle\Entity\Clase
     */
    public function getClase()
    {
        return $this->clase;
    }
	
	
    /**
     * Set clase
     *
     * @param \AppBundle\Entity\Cuenta $cuenta
     *
     * @return cuenta
     */
    public function setCuenta(\AppBundle\Entity\Cuenta $cuenta = null)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return \AppBundle\Entity\Cuenta
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Add anotacione
     *
     * @param \AppBundle\Entity\Anotacion $anotacione
     *
     * @return Subclase
     */
    public function addAnotacione(\AppBundle\Entity\Anotacion $anotacione)
    {
        $this->anotaciones[] = $anotacione;

        return $this;
    }

    /**
     * Remove anotacione
     *
     * @param \AppBundle\Entity\Anotacion $anotacione
     */
    public function removeAnotacione(\AppBundle\Entity\Anotacion $anotacione)
    {
        $this->anotaciones->removeElement($anotacione);
    }

    /**
     * Get anotaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnotaciones()
    {
        return $this->anotaciones;
    }
}
