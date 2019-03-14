<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaPago
 *
 * @ORM\Table(name="formas_pago")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormaPagoRepository")
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
     * @param \AppBundle\Entity\TipoFormaPago $tipo
     *
     * @return FormaPago
     */
    public function setTipo(\AppBundle\Entity\TipoFormaPago $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\TipoFormaPago
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set cuenta
     *
     * @param \AppBundle\Entity\Cuenta $cuenta
     *
     * @return FormaPago
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
     * Set plancargo
     *
     * @param \AppBundle\Entity\PlanCargo $plancargo
     *
     * @return FormaPago
     */
    public function setPlancargo(\AppBundle\Entity\PlanCargo $plancargo = null)
    {
        $this->plancargo = $plancargo;

        return $this;
    }

    /**
     * Get plancargo
     *
     * @return \AppBundle\Entity\PlanCargo
     */
    public function getPlancargo()
    {
        return $this->plancargo;
    }

    /**
     * Add anotacione
     *
     * @param \AppBundle\Entity\Anotacion $anotacione
     *
     * @return FormaPago
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
