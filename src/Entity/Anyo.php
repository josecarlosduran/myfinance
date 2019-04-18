<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anyo
 *
 * @ORM\Table(name="anyos",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\AnyoRepository")
 */
class Anyo
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
     * @ORM\Column(name="anyo", type="string", length=4, unique=true)
     */
    private $anyo;

    /**
     * @var string
     *
     * @ORM\Column(name="anyoCorto", type="string", length=2, unique=true)
     */
    private $anyoCorto;

    /**
     * @var bool
     *
     * @ORM\Column(name="abierto", type="boolean")
     */
    private $abierto;


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
     * Set anyo
     *
     * @param string $anyo
     *
     * @return Anyo
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
     * Set anyoCorto
     *
     * @param string $anyoCorto
     *
     * @return Anyo
     */
    public function setAnyoCorto($anyoCorto)
    {
        $this->anyoCorto = $anyoCorto;

        return $this;
    }

    /**
     * Get anyoCorto
     *
     * @return string
     */
    public function getAnyoCorto()
    {
        return $this->anyoCorto;
    }

    /**
     * Set abierto
     *
     * @param boolean $abierto
     *
     * @return Anyo
     */
    public function setAbierto($abierto)
    {
        $this->abierto = $abierto;

        return $this;
    }

    /**
     * Get abierto
     *
     * @return bool
     */
    public function getAbierto()
    {
        return $this->abierto;
    }
}
