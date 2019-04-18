<?php

namespace App\clases\charts;
use ChartsBundle\Clases\Chart;
/**
 * Clase DoughnutChart
 *
 * @author j.duran
 */
class DoughnutChart extends Chart {
    
    public function __construct($color=array('primarios')){
        parent::__construct('doughnut',$color);
	}
    
	public function opciones(){
		parent::opciones();
		$this->options->cutoutPercentage=50;
	}
	
	
    
    
    
    
    
}