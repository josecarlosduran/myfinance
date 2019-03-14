<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presupuesto	
 *
 * @ORM\Table(name="presupuestos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresupuestoRepository")
 */
class Presupuesto
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
     * @ORM\Column(name="anyo", type="string", length=4)
     */
    private $anyo;
    
	/**
     * @ORM\ManyToOne(targetEntity="Mes")
     * @ORM\JoinColumn(name="mes", referencedColumnName="id")
     */
	
    private $mes;

    /**
     * @var float
     *
     * @ORM\Column(name="importe", type="float")
     */
    private $importe;

    /**
     * @ORM\ManyToOne(targetEntity="Subclase")
     * @ORM\JoinColumn(name="subclase_id", referencedColumnName="id")
     */
    private $subclase;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="unico", type="boolean")
     */
    private $unico;
	

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
     * Set anyo
     *
     * @param string $anyo
     *
     * @return Presupuesto
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;

        return $this;
    }

    /**
     * Get anyo
     *
     * @return string
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set importe
     *
     * @param float $importe
     *
     * @return Presupuesto
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
     * Set mes
     *
     * @param \AppBundle\Entity\Mes $mes
     *
     * @return Presupuesto
     */
    public function setMes(\AppBundle\Entity\Mes $mes = null)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return \AppBundle\Entity\Mes
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set subclase
     *
     * @param \AppBundle\Entity\Subclase $subclase
     *
     * @return Presupuesto
     */
    public function setSubclase(\AppBundle\Entity\Subclase $subclase = null)
    {
        $this->subclase = $subclase;

        return $this;
    }

    /**
     * Get subclase
     *
     * @return \AppBundle\Entity\Subclase
     */
    public function getSubclase()
    {
        return $this->subclase;
    }
	
	/**
     * Set unico
     *
     * @param boolean $unico
     *
     * @return Presupuesto
     */
    public function setUnico($unico)
    {
        $this->unico = $unico;

        return $this;
    }

    /**
     * Get unico
     *
     * @return boolean
     */
    public function getUnico()
    {
        return $this->unico;
    }

	
}
