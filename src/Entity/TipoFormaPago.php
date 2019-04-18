<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoFormaPago
 *
 * @ORM\Table(name="tipos_forma_pago",options={"collate"="utf8_unicode_ci", "charset"="utf8", "engine"="MyISAM"})
 * @ORM\Entity(repositoryClass="App\Repository\TipoFormaPagoRepository")
 */
class TipoFormaPago
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
     * @ORM\Column(name="descripcion", type="string", length=15)
     */
    private $descripcion;


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
     * @return TipoFormaPago
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
}

