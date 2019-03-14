<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanCargo
 *
 * @ORM\Table(name="planes_cargo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanCargoRepository")
 */
class PlanCargo
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
     * @var int
     *
     * @ORM\Column(name="descripcion", type="string")
     */
    private $descripcion;

	
	
	/**
     * @var int
     *
     * @ORM\Column(name="diaInicial1", type="integer")
     */
    private $diaInicial1;

    /**
     * @var int
     *
     * @ORM\Column(name="diaFinal1", type="integer")
     */
    private $diaFinal1;

    /**
     * @var int
     *
     * @ORM\Column(name="diaCargo1", type="integer")
     */
    private $diaCargo1;

    /**
     * @var int
     *
     * @ORM\Column(name="incrementoMes1", type="integer")
     */
    private $incrementoMes1;
	
	/**
     * @var int
     *
     * @ORM\Column(name="diaInicial2", type="integer", nullable=true)
     */
    private $diaInicial2;

    /**
     * @var int
     *
     * @ORM\Column(name="diaFinal2", type="integer", nullable=true)
     */
    private $diaFinal2;

    /**
     * @var int
     *
     * @ORM\Column(name="diaCargo2", type="integer", nullable=true)
     */
    private $diaCargo2;

    /**
     * @var int
     *
     * @ORM\Column(name="incrementoMes2", type="integer", nullable=true)
     */
    private $incrementoMes2;
	



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
     * @return PlanCargo
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
     * Set diaInicial1
     *
     * @param integer $diaInicial1
     *
     * @return PlanCargo
     */
    public function setDiaInicial1($diaInicial1)
    {
        $this->diaInicial1 = $diaInicial1;

        return $this;
    }

    /**
     * Get diaInicial1
     *
     * @return integer
     */
    public function getDiaInicial1()
    {
        return $this->diaInicial1;
    }

    /**
     * Set diaFinal1
     *
     * @param integer $diaFinal1
     *
     * @return PlanCargo
     */
    public function setDiaFinal1($diaFinal1)
    {
        $this->diaFinal1 = $diaFinal1;

        return $this;
    }

    /**
     * Get diaFinal1
     *
     * @return integer
     */
    public function getDiaFinal1()
    {
        return $this->diaFinal1;
    }

    /**
     * Set diaCargo1
     *
     * @param integer $diaCargo1
     *
     * @return PlanCargo
     */
    public function setDiaCargo1($diaCargo1)
    {
        $this->diaCargo1 = $diaCargo1;

        return $this;
    }

    /**
     * Get diaCargo1
     *
     * @return integer
     */
    public function getDiaCargo1()
    {
        return $this->diaCargo1;
    }

    /**
     * Set incrementoMes1
     *
     * @param integer $incrementoMes1
     *
     * @return PlanCargo
     */
    public function setIncrementoMes1($incrementoMes1)
    {
        $this->incrementoMes1 = $incrementoMes1;

        return $this;
    }

    /**
     * Get incrementoMes1
     *
     * @return integer
     */
    public function getIncrementoMes1()
    {
        return $this->incrementoMes1;
    }

    /**
     * Set diaInicial2
     *
     * @param integer $diaInicial2
     *
     * @return PlanCargo
     */
    public function setDiaInicial2($diaInicial2)
    {
        $this->diaInicial2 = $diaInicial2;

        return $this;
    }

    /**
     * Get diaInicial2
     *
     * @return integer
     */
    public function getDiaInicial2()
    {
        return $this->diaInicial2;
    }

    /**
     * Set diaFinal2
     *
     * @param integer $diaFinal2
     *
     * @return PlanCargo
     */
    public function setDiaFinal2($diaFinal2)
    {
        $this->diaFinal2 = $diaFinal2;

        return $this;
    }

    /**
     * Get diaFinal2
     *
     * @return integer
     */
    public function getDiaFinal2()
    {
        return $this->diaFinal2;
    }

    /**
     * Set diaCargo2
     *
     * @param integer $diaCargo2
     *
     * @return PlanCargo
     */
    public function setDiaCargo2($diaCargo2)
    {
        $this->diaCargo2 = $diaCargo2;

        return $this;
    }

    /**
     * Get diaCargo2
     *
     * @return integer
     */
    public function getDiaCargo2()
    {
        return $this->diaCargo2;
    }

    /**
     * Set incrementoMes2
     *
     * @param integer $incrementoMes2
     *
     * @return PlanCargo
     */
    public function setIncrementoMes2($incrementoMes2)
    {
        $this->incrementoMes2 = $incrementoMes2;

        return $this;
    }

    /**
     * Get incrementoMes2
     *
     * @return integer
     */
    public function getIncrementoMes2()
    {
        return $this->incrementoMes2;
    }
}
