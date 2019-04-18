<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anotacion
 *
 * @ORM\Table(name="anotaciones",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\AnotacionRepository")
 */
class Anotacion
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
     * @ORM\Column(name="concepto", type="string", length=255)
     */
    private $concepto;

     /** @var string
     *
     * @ORM\Column(name="concepto_banco", type="string", length=255, nullable=true)
     */
    private $conceptoBanco;


    /**
	* @ORM\ManyToOne(targetEntity="Clase", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="clase", referencedColumnName="id", nullable=true)
	*/
    private $clase;

    /**
	* @ORM\ManyToOne(targetEntity="Subclase", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="subclase", referencedColumnName="id", nullable=true)
	*/
    private $subclase;

     /**
	* @ORM\ManyToOne(targetEntity="Agrupacion", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="agrupacion", referencedColumnName="id", nullable=true)
	*/
    private $agrupacion;

	/**
	* @ORM\ManyToOne(targetEntity="Version", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="version", referencedColumnName="id", nullable=false)
	*/
    private $version;

    /**
     * @var float
     *
     * @ORM\Column(name="importe", type="float")
     */
    private $importe;

     /**
     * @var float
     *
     * @ORM\Column(name="saldo_bancario", type="float",nullable=true)
     */
    private $saldoBancario;

	/**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gasto", type="date")
     */
    private $fechaGasto;


	/**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cargo", type="date")
     */
    private $fechaCargo;



	/**
	* @ORM\ManyToOne(targetEntity="FormaPago", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="formaPago", referencedColumnName="id", nullable=true)
	*/
	private $formaPago;



	/**
	* @ORM\ManyToOne(targetEntity="Cuenta", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="cuenta", referencedColumnName="id", nullable=false)
	*/
	private $cuenta;

	/**
	* @ORM\ManyToOne(targetEntity="Importacion", inversedBy="anotaciones")
	* @ORM\JoinColumn(name="importacion", referencedColumnName="id",onDelete="CASCADE")
	*/
	private $importacion;


	/**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean")
     */
    private $borrado = false;


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
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Anotacion
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

	/**
     * Set concepto Banco
     *
     * @param string $conceptoBanco
     *
     * @return Anotacion
     */
    public function setConceptoBanco($conceptoBanco)
    {
        $this->conceptoBanco = $conceptoBanco;

        return $this;
    }

    /**
     * Get concepto Banco
     *
     * @return string
     */
    public function getConceptoBanco()
    {
        return $this->conceptoBanco;
    }


    /**
     * Set importe
     *
     * @param float $importe
     *
     * @return Anotacion
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set saldoBancario
     *
     * @param float $saldoBancario
     *
     * @return Anotacion
     */
    public function setSaldoBancario($saldoBancario)
    {
        $this->saldoBancario = $saldoBancario;

        return $this;
    }

    /**
     * Get saldoBancario
     *
     * @return float
     */
    public function getSaldoBancario()
    {
        return $this->saldoBancario;
    }

    /**
     * Set fechaGasto
     *
     * @param \DateTime $fechaGasto
     *
     * @return Anotacion
     */
    public function setFechaGasto($fechaGasto)
    {
        $this->fechaGasto = $fechaGasto;

        return $this;
    }

    /**
     * Get fechaGasto
     *
     * @return \DateTime
     */
    public function getFechaGasto()
    {
        return $this->fechaGasto;
    }

    /**
     * Set fechaCargo
     *
     * @param \DateTime $fechaCargo
     *
     * @return Anotacion
     */
    public function setFechaCargo($fechaCargo)
    {
        $this->fechaCargo = $fechaCargo;

        return $this;
    }

    /**
     * Get fechaCargo
     *
     * @return \DateTime
     */
    public function getFechaCargo()
    {
        return $this->fechaCargo;
    }

    /**
     * Set clase
     *
     * @param \App\Entity\Clase $clase
     *
     * @return Anotacion
     */
    public function setClase(\App\Entity\Clase $clase = null)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return \App\Entity\Clase
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set subclase
     *
     * @param \App\Entity\Subclase $subclase
     *
     * @return Anotacion
     */
    public function setSubclase(\App\Entity\Subclase $subclase = null)
    {
        $this->subclase = $subclase;

        return $this;
    }

    /**
     * Get subclase
     *
     * @return \App\Entity\Subclase
     */
    public function getSubclase()
    {
        return $this->subclase;
    }


    /**
     * Set agrupacion
     *
     * @param \App\Entity\Agrupacion $agrupacion
     *
     * @return Anotacion
     */
    public function setAgrupacion(\App\Entity\Agrupacion $agrupacion = null)
    {
        $this->agrupacion = $agrupacion;

        return $this;
    }

    /**
     * Get agrupacion
     *
     * @return \App\Entity\Agrupacion
     */
    public function getAgrupacion()
    {
        return $this->agrupacion;
    }



    /**
     * Set version
     *
     * @param \App\Entity\Version $version
     *
     * @return Anotacion
     */
    public function setVersion(\App\Entity\Version $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \App\Entity\Version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set formaPago
     *
     * @param \App\Entity\FormaPago $formaPago
     *
     * @return Anotacion
     */
    public function setFormaPago(\App\Entity\FormaPago $formaPago = null)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return \App\Entity\FormaPago
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set cuenta
     *
     * @param \App\Entity\Cuenta $cuenta
     *
     * @return Anotacion
     */
    public function setCuenta(\App\Entity\Cuenta $cuenta)
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
     * Set importacion
     *
     * @param \App\Entity\Importacion $importacion
     *
     * @return Anotacion
     */
    public function setImportacion(\App\Entity\Importacion $importacion = null)
    {
        $this->importacion = $importacion;

        return $this;
    }

    /**
     * Get importacion
     *
     * @return \App\Entity\Importacion
     */
    public function getImportacion()
    {
        return $this->importacion;
    }

	/**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Anotacion
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get Borrado
     *
     * @return boolean
     */
    public function getBorrado()
    {
        return $this->borrado;
    }


}
