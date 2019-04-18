<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase
 *
 * @ORM\Table(name="clases",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\ClaseRepository")
 */
class Clase
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
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="clase")
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
     * @return Clase
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
     * Add anotaciones
     *
     * @param \App\Entity\Anotacion $anotaciones
     *
     * @return Clase
     */
    public function addAnotaciones(\App\Entity\Anotacion $anotaciones)
    {
        $this->anotaciones[] = $anotaciones;

        return $this;
    }

    /**
     * Remove anotaciones
     *
     * @param \App\Entity\Anotacion $anotaciones
     */
    public function removeAnotaciones(\App\Entity\Anotacion $anotaciones)
    {
        $this->anotaciones->removeElement($anotaciones);
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
