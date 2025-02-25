<?php

namespace App\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * PresupuestoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PresupuestoRepository extends \Doctrine\ORM\EntityRepository
{
	public function getPaginatePresupuestos($tamanyo = 3,$paginaActual = 1,$anyo = 2018){
        $em=$this->getEntityManager();
        $any = $anyo == null?date('Y'):$anyo;
		
        $dql = "SELECT p,s,c,m FROM App\Entity\Presupuesto p join p.subclase s join s.clase c join p.mes m
				where p.anyo=:anyo ORDER BY m.id ASC,c.descripcion ASC,s.descripcion ASC ";
        $query = $em->createQuery($dql)
                               ->setFirstResult($tamanyo * ($paginaActual - 1))
                               ->setMaxResults($tamanyo)
							   ->setParameter('anyo', $any);
 
        $paginator = new Paginator($query, $fetchJoinCollection = true);
 
        return $paginator;
    }
	
	public function getPresupuestoMeses($anyo){
		$res=array();
		$totales =array();
		$gastos = array();
		$ingresos = array();
		$em=$this->getEntityManager();
		$dql = "select s,c FROM App\Entity\Subclase s join s.clase c order by c.descripcion ASC";
		$query = $em->createQuery($dql);
		$datosEstructura = $query->execute();
		
			
		foreach ($datosEstructura as $linea){
			$elemento=array();
			$elemento['idClase']=$linea->getClase()->getId();
			$elemento['descripcionClase']=$linea->getClase()->getDescripcion();
			$elemento['idSubclase']=$linea->getId();
			$elemento['descripcionSubclase']=$linea->getDescripcion();
			$elemento['meses']=array();
			$dql = "select p,s,m FROM App\Entity\Presupuesto p join p.subclase s join p.mes m where s.id = ".$linea->getId()." and p.anyo=".$anyo;
			$query = $em->createQuery($dql);
			$presupuestos = $query->execute();
			
			foreach ($presupuestos as $presupuesto){
				$elemento['meses'][$presupuesto->getMes()->getId()]['importe'] = $presupuesto->getImporte();
				$elemento['meses'][$presupuesto->getMes()->getId()]['unico'] = $presupuesto->getUnico();
				$totales[$presupuesto->getMes()->getId()][$linea->getClase()->getId()] = isset($totales[$presupuesto->getMes()->getId()][$linea->getClase()->getId()])?$totales[$presupuesto->getMes()->getId()][$linea->getClase()->getId()]+=$presupuesto->getImporte():$presupuesto->getImporte();
				
				if ($presupuesto->getImporte()<0){
					$gastos[$presupuesto->getMes()->getId()] = isset ($gastos[$presupuesto->getMes()->getId()])? $gastos[$presupuesto->getMes()->getId()]+=$presupuesto->getImporte(): $presupuesto->getImporte();   
				}
				else {
					if ($presupuesto->getImporte()>0){
						if ($presupuesto->getSubclase()->getDescripcion()!="Nomina"){
							$ingresos[$presupuesto->getMes()->getId()] = isset ($ingresos[$presupuesto->getMes()->getId()])? $ingresos[$presupuesto->getMes()->getId()]+=$presupuesto->getImporte(): $presupuesto->getImporte();   
						}	
					}
				}
			}
			array_push($res,$elemento);
		}
		return array('subcategorias'=>$res,'categorias'=>$totales,'ingresos'=>$ingresos,'gastos'=>$gastos);
				
	}
        
        public function getGastosPresupuestados($anyo,$mes){
             
            $em=$this->getEntityManager();
			$dql="SELECT sum(p.importe) FROM App\Entity\Presupuesto p 
			  WHERE p.anyo=:anyo AND p.mes=:mes and p.importe<0";
			$query = $em->createQuery($dql);
            $query->setParameter('anyo', $anyo);
            $query->setParameter('mes', $mes);
           
            
            return round($query->getSingleScalarResult(),2);
        }
}
