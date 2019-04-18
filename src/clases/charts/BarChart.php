<?php

namespace App\clases\charts;

/**
 * Clase BarChart
 * @author josec
 */
class BarChart extends Chart{
        protected $stacked;
	public function __construct($stacked = false,$color=array('primarios')){
            parent::__construct('bar',$color);
            $this->stacked = $stacked;
            
	}
        
        public function opciones(){
		parent::opciones();
                $this->setStacked($this->stacked);
                
                //var_dump($this->options);die;
		
	}
        
        public function setStacked(bool $stacked){
            if ($stacked){
                $stacked = new \stdClass();
                $stacked->stacked = true;
                
                $scales = new \stdClass();
                $scales->xAxes = array($stacked);
                $scales->yAxes = array($stacked);
                $this->options->scales = $scales;
            }
        }
        
        public function datos($datasets,$labels,$fill=false){
		$colores = $this->generarColores($this->color[0], count($datasets));
                $datos_dataset = array();
		$res = new \stdClass();
		$i=0;
                foreach($datasets as $dataset){
                $data = array();
                $data['label'] = $dataset['label'];
                if (isset($dataset['discontinua']) && $dataset['discontinua']==true) $data['borderDash'] = [5, 5];
                if (isset($dataset['puntos']) && $dataset['puntos']==false) $data['pointRadius'] = 0;
                
                    foreach ($dataset['valores'] as $dato){
                        $data['data'][] = $dato;
                    }
                $data['borderColor'] = $colores[$i];
                $data['backgroundColor'] = $colores[$i];
                $data['fill'] = $fill;
                $i++;
                array_push($datos_dataset, $data);    
                }
                $res->datasets=$datos_dataset;
		$res->labels=$labels;
		$this->setData($res);
	}
}
