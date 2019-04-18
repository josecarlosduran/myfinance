<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaPago
 *
 * @ORM\Table(name="formas_pago",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\FormaPagoRepository")
 */
class FormaPago
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
	* @ORM\ManyToOne(targetEntity="TipoFormaPago")
	*/
    private $tipo;

	/**
	* @ORM\ManyToOne(targetEntity="Cuenta")
	*/
	private $cuenta;

	/**
	* @ORM\ManyToOne(targetEntity="PlanCargo")
	*/
	private $plancargo;

	/**
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="formaPago")
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
     * @return FormaPago
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
     * Set tipo
     *
     * @param \App\Entity\TipoFormaPago $tipo
     *
     * @return FormaPago
     */
    public function setTipo(\App\Entity\TipoFormaPago $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \App\Entity\TipoFormaPago
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cuenta
     *
     * @param \App\Entity\Cuenta $cuenta
     *
     * @return FormaPago
     */
    public function setCuenta(\App\Entity\Cuenta $cuenta = null)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return \App\Entity\Cuenta
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set plancargo
     *
     * @param \App\Entity\PlanCargo $plancargo
     *
     * @return FormaPago
     */
    public function setPlancargo(\App\Entity\PlanCargo $plancargo = null)
    {
        $this->plancargo = $plancargo;

        return $this;
    }

    /**
     * Get plancargo
     *
     * @return \App\Entity\PlanCargo
     */
    public function getPlancargo()
    {
        return $this->plancargo;
    }

    /**
     * Add anotacione
     *
     * @param \App\Entity\Anotacion $anotacione
     *
     * @return FormaPago
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
