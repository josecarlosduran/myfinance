<?php
namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;

class AnotacionCollection
{


    protected $anotaciones;

    public function __construct()
    {
        $this->anotaciones = new ArrayCollection();
    }



    public function getAnotaciones()
    {
        return $this->anotaciones;
    }
}
