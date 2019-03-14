<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Version
 *
 * @ORM\Table(name="versiones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VersionRepository")
 */
class Version

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
	* @ORM\OneToMany(targetEntity="Anotacion", mappedBy="version")
	*/
	private $anotaciones;

	
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
     * @return Version
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
     * Constructor
     */
    public function __construct()
    {
        $this->anotaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add anotacione
     *
     * @param \AppBundle\Entity\Anotacion $anotacione
     *
     * @return Version
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
