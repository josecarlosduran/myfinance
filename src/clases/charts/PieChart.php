<?php

namespace App\clases\charts;
/**
 * Clase PieChart
 * @author josec
 */
class PieChart extends DoughnutChart{
	public function opciones(){
		parent::opciones();
		$this->options->cutoutPercentage=0;
	}
}
