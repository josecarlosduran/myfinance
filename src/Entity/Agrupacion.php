<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agrupacion
 *
 * @ORM\Table(name="agrupaciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgrupacionRepository")
 */
class Agrupacion
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_desde", type="date",nullable=true)
     */
    private $fechaDesde;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hasta", type="date",nullable=true)
     */
    private $fechaHasta;



    /**
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="agrupacion")
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
     * @return int
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
     * @return Agrupacion
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
     * Set fechaDesde
     *
     * @param date $fechaDesde
     *
     * @return Agrupacion
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return date
     */
    public function getfechaDesde()
    {
        return $this->fechaDesde;
    }


    /**
     * Set fechaHasta
     *
     * @param date $fechaHasta
     *
     * @return Agrupacion
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }

    /**
     * Get fechaHasta
     *
     * @return date
     */
    public function getfechaHasta()
    {
        return $this->fechaHasta;
    }


     /**
     * Add anotacione
     *
     * @param \AppBundle\Entity\Anotacion $anotacione
     *
     * @return Agrupacion
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
