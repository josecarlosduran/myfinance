<?php
namespace App\Controller\inicio;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ChartsBundle\Clases\DoughnutChart;
use ChartsBundle\Clases\PieChart;
use ChartsBundle\Clases\LineChart;
use ChartsBundle\Clases\BarChart;
use App\clases\general\Fecha;


/**
 * Inicio controller.{
 *
 * @Route("/")
 */



class InicioController extends Controller {
	/**
     * Pantalla graficas Resumen.

     * @Route("/", name="inicio_index")
     * @Method("GET")
     */
    public function indexAction()
    {
      $estructuraGraficaCuentas = $this->graficaCuentas();
      $estructuraGraficaAgrupaciones = $this->graficaAgrupaciones();
      $estructuraGraficaEvolucionSaldo = $this->graficaEvolucionSaldo();
		  $estructuraGraficaEvolucionSaldoAnual = $this->graficaEvolucionSaldoAnual();
      $estructuraGraficaAgrupacionesAnual = $this->graficaAgrupacionesAnual();
		  return $this->render('App:inicio:index.html.twig', array(
                                                  'graficaCuentas' => $estructuraGraficaCuentas,
			                                            'graficaAgrupaciones' => $estructuraGraficaAgrupaciones,
                                                  'graficaEvolucionSaldo' => $estructuraGraficaEvolucionSaldo,
                                                  'graficaEvolucionSaldoAnual' => $estructuraGraficaEvolucionSaldoAnual,
                                                  'graficaAgrupacionesAnual' => $estructuraGraficaAgrupacionesAnual,
                          ));
	}

	protected function graficaCuentas(){
  	$dataset=$valores=$labels=array();
  	$cuentas = $this->getDoctrine()->getRepository("App:Cuenta")->findAll();
  	$total = 0;
  	foreach ($cuentas as $cuenta){
  		$valor = $this->getDoctrine()->getRepository("App:Anotacion")->getSaldo($cuenta,new Fecha());
      $valores[] = $valor;
      $labels[] = $cuenta->getDescripcion();
  		$total+= $valor;
  	}
		$dataset['label']="Dataset 1";
    $dataset['valores']=$valores;
		$grafica = new DoughnutChart();
    //$grafica->setTitle("Saldo Cuentas Bancarias ($total)");
		$grafica->opciones();
    $grafica->datos(array($dataset),$labels);
    $datos = ["total"=>$total];
		return array("grafica"=>$grafica->generate(),"datos"=>$datos);
	}

	protected function graficaAgrupaciones()
  {
		$datos=$valores=$labels=array();
		$año = date("Y");
		$mes = date("n");
		$agrupaciones = $this->getDoctrine()->getRepository("App:Anotacion")->getAnotacionesAgrupadas(1,2,$año,$mes);
		$datosClases = $agrupaciones['totales'];

		$total = 0;
		foreach ($datosClases as $id=>$datoClase){
			if ($datoClase < 0){
				$clase = $this->getDoctrine()->getRepository("App:Clase")->find($id);
				$datos[$clase->getDescripcion()] = (float)abs($datoClase);
				$total+= (float)abs($datoClase);

			}
		}
		arsort($datos);
		foreach ($datos as $label=>$dato){
                    $valores[] = $dato;
                    $labels[] = $label;
                }

                $dataset['label']="Dataset 1";
                $dataset['valores']=$valores;


		$grafica = new DoughnutChart();
		//$grafica->setTitle("Gastos por categorias ($total)");
		$grafica->opciones();
		$grafica->datos(array($dataset),$labels);
    $datos = ["total"=>$total];
		return array("grafica"=>$grafica->generate(),"datos"=>$datos);
	}

  protected function graficaEvolucionSaldo()
  {
    $dataset=$valores=$labels=array();
    $cuentas = $this->getDoctrine()->getRepository("App:Cuenta")->findAll();

    $datasets = array();
    foreach ($cuentas as $cuenta){

      $fechaActual = new Fecha();
      $anyoActual = $fechaActual->anyo();
      $mesActual = $fechaActual->mes();

      $fecha = new Fecha();
      $fecha = $fecha->primerDiaMes();
      $fecha->restaDias(1);
      $labels =$valores= array();

      while ($fecha <= $fechaActual){

          $labels[] = $fecha->dia();

          $valor = $this->getDoctrine()->getRepository("App:Anotacion")->getSaldo($cuenta,$fecha);

          $valores[]=$valor;

          $fecha->sumaDias(1);
      }

      $dataset['label']=$cuenta->getDescripcion();
      $dataset['valores']=$valores;
      //$dataset['discontinua']=true;
      array_push($datasets,$dataset);
    }

    //presupuesto
    $nomina=1660;
    $gastosMesPresupuestados = $this->getDoctrine()->getRepository("App:Presupuesto")->getGastosPresupuestados($anyoActual,$mesActual);;

    $fecha = new Fecha();
    $fecha = $fecha->primerDiaMes();
    $fecha->restaDias(1);
    $labels =$valores= array();

    $fechaFinal = new Fecha();
    $fechaFinal->ultimoDiaMes();

    $fechaNomina = new Fecha();
    $fechaNomina->ultimoDiaMes();
    $fechaNomina->restaDias(1);

    $diasMes = $fechaFinal->dia();
    $gastoDia = round($gastosMesPresupuestados / $diasMes,2);

    $valor = $this->getDoctrine()->getRepository("App:Anotacion")->getSaldo(1,$fecha);
      while ($fecha <= $fechaFinal){
          $labels[] = $fecha->dia();
          $valores[]=$valor;
          $fecha->sumaDias(1);
          $valor+=$gastoDia;
    if ($fecha == $fechaNomina) {
    $valor += $nomina;
    }
      }

      $dataset['label']="PRESUPUESTO";
      $dataset['valores']=$valores;
      $dataset['discontinua']=true;
      $dataset['puntos']=false;
      array_push($datasets,$dataset);

    $grafica = new LineChart();
    //$grafica->setTitle("Evolucion Saldo Mensual");
    $grafica->opciones();
    $grafica->datos($datasets,$labels);
    $datos=array();
    return array("grafica"=>$grafica->generate(),"datos"=>$datos);
        }

        protected function graficaEvolucionSaldoAnual(){


                $dataset=$valores=$labels=array();
                $cuentas = $this->getDoctrine()->getRepository("App:Cuenta")->findAll();

                $datasets = array();
                foreach ($cuentas as $cuenta){

                    $fechaActual = new Fecha();
                    $anyoActual = $fechaActual->anyo();
                    $mesActual = $fechaActual->mes();
                    $fechaActual->primerDiaMes();
                    $fechaActual->restaDias(1);
                    $ultimoDia = $fechaActual->format("d");
                    $fecha = new Fecha();
                    $fecha = $fecha->primerDiaAnyo();

                    $labels =$valores= array();
                    $mes=1;

                    $dias =array("01","15");
                    //var_dump($fecha);die;
                    while ($mes <$mesActual){
                        if ($mes == $mesActual - 1){
                            $dias[] = $ultimoDia;
                        }
                        foreach($dias as $dia){
                            $labels[] = $dia."/".str_pad($mes, 2,"0",STR_PAD_LEFT);
                            $fecha=$anyoActual."-". str_pad($mes, 2,"0",STR_PAD_LEFT)."-".$dia;
                            $valor = $this->getDoctrine()->getRepository("App:Anotacion")->getSaldoBancario($cuenta,$fecha);
                            $valores[]=$valor['saldo'];
                        }
                       $mes++;
                    }

                    $dataset['label']=$cuenta->getDescripcion();
                    $dataset['valores']=$valores;
                    //$dataset['discontinua']=true;
                    //var_dump($dataset);die;
                    array_push($datasets,$dataset);
                }



                $grafica = new LineChart();
                //$grafica->setTitle("Evolucion Saldo Anual");
		$grafica->opciones();
		$grafica->datos($datasets,$labels);
    $datos=array();
    return array("grafica"=>$grafica->generate(),"datos"=>$datos);
        }


        function graficaAgrupacionesAnual(){
            $datos = array();
            $total = 0;
            $labels = $dataset = $datasets = array();
            $año = date("Y");
            $mesFinal = date("n")-1;
	    //var_dump($mesFinal);die;
            for($mes = 1;$mes<=$mesFinal;$mes++){
                $agrupaciones = $this->getDoctrine()->getRepository("App:Anotacion")->getAnotacionesAgrupadas(1,1,$año,$mes);
                //var_dump($agrupaciones);die;
                $datosClases = $agrupaciones['totales'];

                foreach ($datosClases as $id=>$datoClase){
                            if ($datoClase < 0){
                                    $clase = $this->getDoctrine()->getRepository("App:Clase")->find($id);
                                    $datos[$clase->getDescripcion()][$mes] = (float)abs($datoClase);
                                    $total+= (float)abs($datoClase);

                            }
                    }
                $labels[] = Fecha::$nombreMeses[$mes-1];
              }




             foreach ($datos as $label=>$valores){

                $valores = $this->rellenarValoresVacios($mesFinal, $valores);

                $dataset['label']=$label;
                $dataset['valores']=$valores;
                array_push($datasets,$dataset);
             }

             $grafica = new BarChart(true);
             //$grafica->setTitle("Evolucion Gastos Anual");
	     $grafica->opciones();
	     $grafica->datos($datasets,$labels);
       $datos=array();
       return array("grafica"=>$grafica->generate(),"datos"=>$datos);

        }


        private function rellenarValoresVacios($mesFinal,$valores){
            for($mes = 1;$mes<=$mesFinal;$mes++){
                if (!isset($valores[$mes])){
                    $valores[$mes] = 0;
                }
                $valores[$mes] = number_format($valores[$mes], 2);
            }

            ksort($valores);
            return $valores;

        }

}
