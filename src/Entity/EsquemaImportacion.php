<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EsquemaImportacion
 *
 * @ORM\Table(name="esquemas_importacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EsquemaImportacionRepository")
 */
class EsquemaImportacion
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
	* @ORM\ManyToOne(targetEntity="Cuenta")
	*/
    private $cuenta;

    /**
     * @var int
     *
     * @ORM\Column(name="lineasCabecera", type="integer")
     */
    private $lineasCabecera;

    /**
     * @var string
     *
     * @ORM\Column(name="separadorCampos", type="string", length=255)
     */
    private $separadorCampos;

	/**
     * @var string
     *
     * @ORM\Column(name="puntoDecimal", type="string", length=255)
     */
    private $puntoDecimal;

	/**
     * @var string
     *
     * @ORM\Column(name="separadorMiles", type="string", length=255)
     */
    private $separadorMiles;


	/**
     * @var string
     *
     * @ORM\Column(name="formatoFecha", type="string", length=255)
     */
    private $formatoFecha;

    /**
     * @var bool
     *
     * @ORM\Column(name="inversionSigno", type="boolean")
     */
    private $inversionSigno;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo1", type="string", length=255, nullable=true)
     */
    private $campo1;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo2", type="string", length=255, nullable=true)
     */
    private $campo2;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo3", type="string", length=255, nullable=true)
     */
    private $campo3;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo4", type="string", length=255, nullable=true)
     */
    private $campo4;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo5", type="string", length=255, nullable=true)
     */
    private $campo5;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo6", type="string", length=255, nullable=true)
     */
    private $campo6;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo7", type="string", length=255, nullable=true)
     */
    private $campo7;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo8", type="string", length=255, nullable=true)
     */
    private $campo8;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo9", type="string", length=255, nullable=true)
     */
    private $campo9;

    /**
     * @var string
     *
     * @ORM\Column(name="Campo10", type="string", length=255, nullable=true)
     */
    private $campo10;





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
     * @return EsquemaImportacion
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
     * Set lineasCabecera
     *
     * @param integer $lineasCabecera
     *
     * @return EsquemaImportacion
     */
    public function setLineasCabecera($lineasCabecera)
    {
        $this->lineasCabecera = $lineasCabecera;

        return $this;
    }

    /**
     * Get lineasCabecera
     *
     * @return integer
     */
    public function getLineasCabecera()
    {
        return $this->lineasCabecera;
    }

    /**
     * Set separadorCampos
     *
     * @param string $separadorCampos
     *
     * @return EsquemaImportacion
     */
    public function setSeparadorCampos($separadorCampos)
    {
        $this->separadorCampos = $separadorCampos;

        return $this;
    }

    /**
     * Get separadorCampos
     *
     * @return string
     */
    public function getSeparadorCampos()
    {
        return $this->separadorCampos;
    }

    /**
     * Set puntoDecimal
     *
     * @param string $puntoDecimal
     *
     * @return EsquemaImportacion
     */
    public function setPuntoDecimal($puntoDecimal)
    {
        $this->puntoDecimal = $puntoDecimal;

        return $this;
    }

    /**
     * Get puntoDecimal
     *
     * @return string
     */
    public function getPuntoDecimal()
    {
        return $this->puntoDecimal;
    }

    /**
     * Set separadorMiles
     *
     * @param string $separadorMiles
     *
     * @return EsquemaImportacion
     */
    public function setSeparadorMiles($separadorMiles)
    {
        $this->separadorMiles = $separadorMiles;

        return $this;
    }

    /**
     * Get separadorMiles
     *
     * @return string
     */
    public function getSeparadorMiles()
    {
        return $this->separadorMiles;
    }

    /**
     * Set formatoFecha
     *
     * @param string $formatoFecha
     *
     * @return EsquemaImportacion
     */
    public function setFormatoFecha($formatoFecha)
    {
        $this->formatoFecha = $formatoFecha;

        return $this;
    }

    /**
     * Get formatoFecha
     *
     * @return string
     */
    public function getFormatoFecha()
    {
        return $this->formatoFecha;
    }

    /**
     * Set inversionSigno
     *
     * @param boolean $inversionSigno
     *
     * @return EsquemaImportacion
     */
    public function setInversionSigno($inversionSigno)
    {
        $this->inversionSigno = $inversionSigno;

        return $this;
    }

    /**
     * Get inversionSigno
     *
     * @return boolean
     */
    public function getInversionSigno()
    {
        return $this->inversionSigno;
    }

    /**
     * Set campo1
     *
     * @param string $campo1
     *
     * @return EsquemaImportacion
     */
    public function setCampo1($campo1)
    {
        $this->campo1 = $campo1;

        return $this;
    }

    /**
     * Get campo1
     *
     * @return string
     */
    public function getCampo1()
    {
        return $this->campo1;
    }

    /**
     * Set campo2
     *
     * @param string $campo2
     *
     * @return EsquemaImportacion
     */
    public function setCampo2($campo2)
    {
        $this->campo2 = $campo2;

        return $this;
    }

    /**
     * Get campo2
     *
     * @return string
     */
    public function getCampo2()
    {
        return $this->campo2;
    }

    /**
     * Set campo3
     *
     * @param string $campo3
     *
     * @return EsquemaImportacion
     */
    public function setCampo3($campo3)
    {
        $this->campo3 = $campo3;

        return $this;
    }

    /**
     * Get campo3
     *
     * @return string
     */
    public function getCampo3()
    {
        return $this->campo3;
    }

    /**
     * Set campo4
     *
     * @param string $campo4
     *
     * @return EsquemaImportacion
     */
    public function setCampo4($campo4)
    {
        $this->campo4 = $campo4;

        return $this;
    }

    /**
     * Get campo4
     *
     * @return string
     */
    public function getCampo4()
    {
        return $this->campo4;
    }

    /**
     * Set campo5
     *
     * @param string $campo5
     *
     * @return EsquemaImportacion
     */
    public function setCampo5($campo5)
    {
        $this->campo5 = $campo5;

        return $this;
    }

    /**
     * Get campo5
     *
     * @return string
     */
    public function getCampo5()
    {
        return $this->campo5;
    }

    /**
     * Set campo6
     *
     * @param string $campo6
     *
     * @return EsquemaImportacion
     */
    public function setCampo6($campo6)
    {
        $this->campo6 = $campo6;

        return $this;
    }

    /**
     * Get campo6
     *
     * @return string
     */
    public function getCampo6()
    {
        return $this->campo6;
    }

    /**
     * Set campo7
     *
     * @param string $campo7
     *
     * @return EsquemaImportacion
     */
    public function setCampo7($campo7)
    {
        $this->campo7 = $campo7;

        return $this;
    }

    /**
     * Get campo7
     *
     * @return string
     */
    public function getCampo7()
    {
        return $this->campo7;
    }

    /**
     * Set campo8
     *
     * @param string $campo8
     *
     * @return EsquemaImportacion
     */
    public function setCampo8($campo8)
    {
        $this->campo8 = $campo8;

        return $this;
    }

    /**
     * Get campo8
     *
     * @return string
     */
    public function getCampo8()
    {
        return $this->campo8;
    }

    /**
     * Set campo9
     *
     * @param string $campo9
     *
     * @return EsquemaImportacion
     */
    public function setCampo9($campo9)
    {
        $this->campo9 = $campo9;

        return $this;
    }

    /**
     * Get campo9
     *
     * @return string
     */
    public function getCampo9()
    {
        return $this->campo9;
    }

    /**
     * Set campo10
     *
     * @param string $campo10
     *
     * @return EsquemaImportacion
     */
    public function setCampo10($campo10)
    {
        $this->campo10 = $campo10;

        return $this;
    }

    /**
     * Get campo10
     *
     * @return string
     */
    public function getCampo10()
    {
        return $this->campo10;
    }

    /**
     * Set cuenta
     *
     * @param \AppBundle\Entity\Cuenta $cuenta
     *
     * @return EsquemaImportacion
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
}
