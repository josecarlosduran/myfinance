<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Importacion
 *
 * @ORM\Table(name="importaciones",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\ImportacionRepository")
 */
class Importacion
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
     * @ORM\Column(name="descripcion", type="string", length=255, unique=true)
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_registros", type="integer",nullable=true)
     */
    private $numeroRegistros;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="date")
     */
    private $fechaCarga;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="importacion")
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
     * @return Importacion
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
     * Set numeroRegistros
     *
     * @param integer $numeroRegistros
     *
     * @return Importacion
     */
    public function setNumeroRegistros($numeroRegistros)
    {
        $this->numeroRegistros = $numeroRegistros;

        return $this;
    }

    /**
     * Get numeroRegistros
     *
     * @return integer
     */
    public function getNumeroRegistros()
    {
        return $this->numeroRegistros;
    }

    /**
     * Set fechaCarga
     *
     * @param \DateTime $fechaCarga
     *
     * @return Importacion
     */
    public function setFechaCarga($fechaCarga)
    {
        $this->fechaCarga = $fechaCarga;

        return $this;
    }

    /**
     * Get fechaCarga
     *
     * @return \DateTime
     */
    public function getFechaCarga()
    {
        return $this->fechaCarga;
    }

    /**
     * Add anotacione
     *
     * @param \App\Entity\Anotacion $anotacione
     *
     * @return Importacion
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
