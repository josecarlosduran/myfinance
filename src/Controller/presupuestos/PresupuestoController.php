<?php

namespace App\Controller\presupuestos;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Presupuesto;
use App\clases\general\Fecha;

/**
 * Presupuesto controller.{
 *
 * @Route("presupuesto")
 */
class PresupuestoController extends Controller
{
    /** 
     * Lists all presupuesto entities.
    
     * @Route("/list/{numPag}", name="presupuesto_index")
     * @Method("GET")
     */
    public function indexAction($numPag=1)
    {
        
		$em = $this->getDoctrine()->getManager();
		$PresupuestoRepository = $em->getRepository("App:Presupuesto");
        $pageSize = $this->getParameter('numero_lineas');
		$paginator = $PresupuestoRepository->getPaginatePresupuestos($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);
		return $this->render('App:presupuestos:index.html.twig', array(
            'presupuestos' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }
	
	/**
     * Creates a new cuenta entity.
     *
     * @Route("/new/", name="presupuesto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $presupuesto = Array();
		$form = $this->createForm('App\Form\presupuestos\PresupuestoType', $presupuesto);
		 
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
			$anyo = $data['anyo']->getAnyo();
			$meses = $data['meses'];
			$clase = $data['clase'];
			$subclase = $data['subclase'];
			$importe = $data['importe'];
			$unico = $data['unico'];
			foreach($meses as $mes){
				$presupuesto = new Presupuesto();
				$presupuesto->setAnyo($anyo);
				$presupuesto->setMes($mes);
				$presupuesto->setSubclase($subclase);
				$presupuesto->setImporte($importe);
				$presupuesto->setUnico($unico);
				$em->persist($presupuesto);
			}
			
            $em->flush();
			
            return $this->redirectToRoute('presupuesto_index');
        }

        return $this->render('App:presupuestos:edit.html.twig', array(
            'presupuesto' => $presupuesto,
            'form' => $form->createView(),
			'accion' => 'Nuevo'
        ));
    }
	
	
	
	/**
     * Displays a form to edit an existing presupuesto entity.
     *
     * @Route("/{id}/edit", name="presupuesto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Presupuesto $presupuesto)
    {
		$presupuestoArray=array();
        $presupuestoArray['id'] = $presupuesto->getId();		
		$presupuestoArray['meses'] = $presupuesto->getMes();
		$presupuestoArray['clase'] = $presupuesto->getSubclase()->getClase();
		$presupuestoArray['subclase'] = $presupuesto->getSubclase();
		$presupuestoArray['importe'] = $presupuesto->getImporte();
		$presupuestoArray['unico'] = $presupuesto->getUnico();
		
		$options = array('modo' => 'editar');
		$editForm = $this->createForm('App\Form\presupuestos\PresupuestoType', $presupuestoArray,$options);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $editForm->getData();
			
			$id = $data['id'];
			$subclase = $data['subclase'];
			$importe = $data['importe'];
			$unico = $data['unico'];
			$presupuesto = $em->getRepository('App:Presupuesto')->find($id);
			$presupuesto->setSubclase($subclase);
			$presupuesto->setImporte($importe);
			$presupuesto->setUnico($unico);
			
			$em->persist($presupuesto);
			$em->flush();

            return $this->redirectToRoute('presupuesto_index');
        }
		
        return $this->render('App:presupuestos:edit.html.twig', array(
            'presupuesto' => $presupuesto,
			'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

	 /**
     * Deletes a presupuesto entity.
     *
     * @Route("/delete", name="presupuesto_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$presupuesto = $em->getRepository("App:Presupuesto")->find($id);
            $em->remove($presupuesto);
            $em->flush();
        

        return $this->redirectToRoute('presupuesto_index');
    }
	

    /** 
     * Planificacion
    
     * @Route("/planificacion", name="presupuesto_planificacion")
     * @Method("GET")
     */
    public function planificacionAction(Request $request)
    {
		$anyoSelect = $request->get("anyoselect");
		$mesActual = Fecha::mesActual();
		$em = $this->getDoctrine()->getManager();
		$meses = $em->getRepository("App:Mes")->findBy(array(), array('id' => 'ASC'));
		$anyos = $em->getRepository("App:Anyo")->findBy(array(), array('anyo' => 'DESC'));
		if($anyoSelect==null){
			$anyoEntity = $em->getRepository("App:Anyo")->findOneBy(array(), array('anyo' => 'DESC'));
		}
		else{
			$anyoEntity = $em->getRepository("App:Anyo")->find($anyoSelect);
		}
		$anyo = $anyoEntity->getAnyo();
			
		$PresupuestoRepository = $em->getRepository("App:Presupuesto");
       	$presupuestoMeses = $PresupuestoRepository->getPresupuestoMeses($anyo);
		
		$cuentaDefecto = $em->getRepository("App:Cuenta")->find(1);
		
		//$anotaciones = $em->getRepository("App:Anotacion")->getAnotacionesAgrupadas(2,$anyo,1);
		
		$movimientos = array();
		foreach ($meses as $mes){
			$idMes = $mes->getId();
			$fecha = new Fecha($anyo."-".str_pad($idMes, 2, "0", STR_PAD_LEFT)."-01");//Primer dia de un mes dado
			$fecha->restaDias(1);
                        $datosSaldo =  $em->getRepository("App:Anotacion")->getSaldoBancario($cuentaDefecto,$fecha);
			$saldoMesAnterior[$idMes] = $datosSaldo['saldo'];
			$hay = $em->getRepository("App:Anotacion")->hasAnotaciones($cuentaDefecto,1,$anyo,$idMes);
			if ($hay){
				//si hay Movimientos Definitivos
				$anotaciones = $em->getRepository("App:Anotacion")->getAnotacionesAgrupadas($cuentaDefecto,1,$anyo,$idMes);
				$movimientos[$idMes]=$anotaciones;
			}
			else{
				//si no con los provisionales mes
				$anotaciones = $em->getRepository("App:Anotacion")->getAnotacionesAgrupadas($cuentaDefecto,2,$anyo,$idMes);
				$movimientos[$idMes]=$anotaciones;
			}
			
		}
		
		
		
		
		return $this->render('App:presupuestos:planificacion.html.twig', array(
            'presupuestoMeses' => $presupuestoMeses['subcategorias'],
			'totales' => $presupuestoMeses['categorias'],
			'ingresosPresupuesto' => $presupuestoMeses['ingresos'],
			'gastosPresupuesto' => $presupuestoMeses['gastos'],
			'movimientos' => $movimientos,
			'meses' => $meses,
			'anyos' => $anyos,
			'saldoMesAnterior' =>$saldoMesAnterior,
			'mesActual'=> $mesActual,
			'anyoSelect'=> $anyoSelect,
                        'anyo'=>$anyo
		));
    }
	
	
}
