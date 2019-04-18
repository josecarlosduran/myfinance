<?php

namespace App\clases\charts;
/**
 * Clase LineChart
 * @author josec
 */
class LineChart extends Chart{
	public function __construct($color=array('primarios')){
            parent::__construct('line',$color);
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
