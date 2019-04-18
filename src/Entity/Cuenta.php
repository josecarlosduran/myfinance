<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuenta
 *
 * @ORM\Table(name="cuentas",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\CuentaRepository")
 */
class Cuenta

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
     * @ORM\Column(name="Descripcion", type="string", length=24)
     */
    private $descripcion;

	/**
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="cuenta")
	*/
	private $anotaciones;

	/**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", length=80)
     */
	private $IBAN;

	/**
     * @var bool
     *
     * @ORM\Column(name="cuenta_ahorro", type="boolean", length=80)
     */
	private $cuentaAhorro;


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
     * @return Cuenta
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
     * Set iBAN
     *
     * @param string $iBAN
     *
     * @return Cuenta
     */
    public function setIBAN($iBAN)
    {
        $this->IBAN = $iBAN;

        return $this;
    }

    /**
     * Get iBAN
     *
     * @return string
     */
    public function getIBAN()
    {
        return $this->IBAN;
    }

    /**
     * Set cuentaAhorro
     *
     * @param string $cuentaAhorro
     *
     * @return Cuenta
     */
    public function setCuentaAhorro($cuentaAhorro)
    {
        $this->cuentaAhorro = $cuentaAhorro;

        return $this;
    }

    /**
     * Get cuentaAhorro
     *
     * @return string
     */
    public function getCuentaAhorro()
    {
        return $this->cuentaAhorro;
    }

    /**
     * Add anotacione
     *
     * @param \App\Entity\Anotacion $anotacione
     *
     * @return Cuenta
     */
    public function addAnotacione(\App\Entity\Anotacion $anotacione)
    {
        $this->anotaciones[] = $anotacione;

        return $this;
    }

    /**
     * Remove anotacione
     *
     * @param \App\Entity\Anotacion $anotacione
     */
    public function removeAnotacione(\App\Entity\Anotacion $anotacione)
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
