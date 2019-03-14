<?php
namespace App\clases\general;

use DateTime;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fecha
 *
 * @author j.duran
 */
class Fecha extends DateTime{

    public static $nombreMeses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    public function __toString() {
        return $this->format('Y-m-d');
    }

    public function toDB() {
        return $this->format('Y-m-d');
    }

    public function toHuman($sep="-") {
        return $this->format('d'.$sep.'m'.$sep.'Y');
    }

    public function dia(){
        return $this->format('d');
    }
    public function mes(){
        return $this->format('m');
    }
    public function anyo(){
        return $this->format('Y');
    }

    public function sumaDias($numeroDias){
        return $this->modify("+ $numeroDias day");
    }
    public function restaDias($numeroDias){
        return $this->modify("- $numeroDias day");
    }

    public function sumaMeses($numeroMeses){
        return $this->modify("+ $numeroMeses month");
    }
    public function restaMeses($numeroMeses){
        return $this->modify("- $numeroMeses month");
    }
    public function primerDiaMes(){
         return $this->modify("first day of this month");
    }
    public function ultimoDiaMes(){
         return $this->modify("last day of this month");
    }
    public function primerDiaAnyo(){
        return $this->modify("first day of january ".$this->anyo());

    }

    public function ultimoDiaAnyo(){
        return $this->modify("las day of this year");
    }
	public static function mesActual(){
		return date("n");
	}

    public function cambiaFecha($dia,$incrementoMeses){
        $this->primerDiaMes();
        $this->sumaMeses($incrementoMeses);
        $this->ultimoDiaMes();
        $diaFinal=$this->dia();
        if($dia<$diaFinal){
            $nuevoDia=$dia;
        }
        else {
            $nuevoDia=$diaFinal;
        }

        $anyo=$this->anyo();
        $mes = $this->mes();
        $this->setDate($anyo,$mes,$nuevoDia);

        return $this;

    }
}
