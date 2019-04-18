<?php

namespace App\Controller\anotaciones;

use App\Entity\Anotacion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\datos_maestros\AnotacionSinClasificarType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\clases\general\Fecha;
use App\Entity\AnotacionCollection;

/**
 * Clase controller.{
 *
 * @Route("anotacion")
 */
class AnotacionController extends Controller
{
    /** 
     * Lists all anotacion entities.
    
     * @Route("/list/{numPag}", name="anotacion_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request,$numPag = 1)
    {
   		$session = $request->getSession();

		$datosFiltro=array();
		
		if (!$session->get('datosFiltro')){
			$datosFiltro['fechaInicio']= new Fecha();
			$datosFiltro['fechaInicio']->restaMeses(1);
			$datosFiltro['fechaFin']= new Fecha();
			$datosFiltro['tipoFecha'] = 'fechaGasto';
			$datosFiltro['cuenta'] = null;
                        $datosFiltro['categoria'] = null;
                        $datosFiltro['subcategoria'] = null;
                        $datosFiltro['agrupacion'] = null;
			$session->set('datosFiltro',$datosFiltro);
		}
		else {
			$datosFiltro = $session->get('datosFiltro');
			$datosFiltro['cuenta'] = null;
                        $datosFiltro['categoria'] = $datosFiltro['categoria']!=null?$datosFiltro['categoria']->getId():null;
                        $datosFiltro['subcategoria'] = $datosFiltro['subcategoria']!=null?$datosFiltro['subcategoria']->getId():null;
                        $datosFiltro['agrupacion'] = $datosFiltro['agrupacion']!=null?$datosFiltro['agrupacion']->getId():null;
                       
		}
		
		$formFiltro = $this->createFormBuilder($datosFiltro)
						->add('fechaInicio', DateType::class, array(
							'input' => 'datetime',
							'widget' => 'single_text',
							'attr' => array('class'=>'calendar', 'read_only' => true)))
						->add('fechaFin', DateType::class, array(
							'input' => 'datetime',
							'widget' => 'single_text',
							'attr' => array('class'=>'calendar', 'read_only' => true)))
						->add('tipoFecha', ChoiceType::class, array(
							'choices'  => array(
							'Por Gasto' => 'fechaGasto',
							'Por Cargo' => 'fechaCargo')
							))
						->add('cuenta', EntityType::class,array('class'=>'App:Cuenta',
												'query_builder' => function ($er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.id', 'ASC');
												},
												'choice_label' => 'descripcion',
												
												))
                                                ->add('categoria', EntityType::class,array('class'=>'App:Clase',
												'query_builder' => function ($er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
                                                                                                'placeholder' => 'TODAS',
												'choice_label' => 'descripcion',
                                                                                                'required' => false,
												
												))
                                                ->add('subcategoria', EntityType::class,array('class'=>'App:Subclase',
												'query_builder' => function ($er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
                                                                                                'placeholder' => 'TODAS',
												'choice_label' => 'descripcion',
                                                                                                'required' => false,
												
												))
                                                ->add('agrupacion', EntityType::class,array('class'=>'App:Agrupacion',
												'query_builder' => function ($er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
                                                                                                'placeholder' => 'TODAS',
												'choice_label' => 'descripcion',
                                                                                                'required' => false,
												
												))
						->add('Filtrar', SubmitType::class,array('attr'=>array("class"=>"btn btn-info")))
						->getForm();
										
		$formFiltro->handleRequest($request);
		
		if ($formFiltro->isSubmitted() && $formFiltro->isValid()) {
			$datosFiltro = $formFiltro->getData();
			
			$session->set('datosFiltro',$datosFiltro);
		}
		
		$fechaInicio = new Fecha($datosFiltro['fechaInicio']->format('Y-m-d'));
		$fechaFin = new Fecha($datosFiltro['fechaFin']->format('Y-m-d'));
		$tipoFecha = $datosFiltro['tipoFecha'];
		$cuenta = $datosFiltro['cuenta'];
                $categoria = $datosFiltro['categoria'];
                $subcategoria = $datosFiltro['subcategoria'];
                $agrupacion = $datosFiltro['agrupacion'];
		$em = $this->getDoctrine()->getManager();
		$AnotacionRepository = $em->getRepository("App:Anotacion");
                $pageSize = $this->getParameter('numero_lineas');
                $sumaImportes = $AnotacionRepository->sumaImportes($fechaInicio->toDB(), $fechaFin->toDB(), $tipoFecha,$cuenta,$categoria,$subcategoria,$agrupacion);        
		$importeAnotaciones = number_format((float)$sumaImportes['importe'],2)." €";
                
                $saldo = $AnotacionRepository->getSaldo($cuenta,$fechaFin);
                $paginator = $AnotacionRepository->getPaginateAnotaciones($fechaInicio->toDB(),$fechaFin->toDB(),$tipoFecha,$cuenta,$categoria,$subcategoria,$agrupacion,"a.fechaGasto","DESC",$pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);
		
        return $this->render('App:anotaciones:index.html.twig', array(
            'formFiltro' => $formFiltro->createView(),
            'importeAnotaciones'=>$importeAnotaciones,
            'saldo'=>$saldo,
	        'anotaciones' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new anotacion entity.
     *
     * @Route("/new/", name="anotacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $versionProvisional = $this->getDoctrine()->getManager()->getRepository('App:Version')->find(2);
		$anotacion = new Anotacion();
		
		$anotacion->setFechaGasto(new Fecha());
        $form = $this->createForm('App\Form\anotaciones\AnotacionType', $anotacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
			
			$fechaGasto = $anotacion->getFechaGasto();
			$planCargo = $anotacion->getFormaPago()->getPlancargo();
			$fechaCargo = $this->calculaFechaCargo($planCargo, $fechaGasto->format('Y-m-d'));
			$anotacion->setFechaCargo(new fecha($fechaCargo));
			$anotacion->setVersion($versionProvisional);
			$anotacion->setCuenta($anotacion->getFormaPago()->getCuenta());
			$em->persist($anotacion);
            
			if ($anotacion->getSubclase()->getCuenta()!=null){
				$anotacion2 = new Anotacion();
				$anotacion2->setClase($anotacion->getClase());
				$anotacion2->setSubclase($anotacion->getSubclase());
				$anotacion2->setVersion($versionProvisional);
				$anotacion2->setCuenta($anotacion->getSubclase()->getCuenta());
				$anotacion2->setConcepto($anotacion->getConcepto());
				$anotacion2->setImporte($anotacion->getImporte() * (-1));
				$anotacion2->setFechaGasto($anotacion->getFechaGasto());
				$anotacion2->setFechaCargo($anotacion->getFechaCargo());
				$anotacion2->setFormaPago($anotacion->getFormaPago());
				$em->persist($anotacion2);
			}
			
			
			$em->flush();
			
            return $this->redirectToRoute('anotacion_index');
        }

        return $this->render('App:anotaciones:edit.html.twig', array(
            'anotacion' => $anotacion,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    private function calculaFechaCargo($planCargo,$fechaGasto){
		
		$fecha = new Fecha($fechaGasto);
		
		$dia = $fecha->dia();
		if ($planCargo!=null){
				if($dia >= $planCargo->getDiaInicial1() && $dia<= $planCargo->getDiaFinal1()){
					$diaCargo = $planCargo->getDiaCargo1();
					$incrementoMeses = $planCargo->getIncrementoMes1();
				}
				else{
					if($dia >= $planCargo->getDiaInicial2() && $dia<= $planCargo->getDiaFinal2()){
						$diaCargo = $planCargo->getDiaCargo2();
						$incrementoMeses = $planCargo->getIncrementoMes2();
					}
					else{
						$diaCargo = $dia;
						$incrementoMeses = 0;
					}
				}
				
				$fecha->cambiaFecha($diaCargo, $incrementoMeses);
				$fechaCargo = $fecha->toDB();
			}
		else{
			$fechaCargo = $fechaGasto;
		}
		return $fechaCargo;
	} 

    /**
     * Displays a form to edit an existing anotacion entity.
     *
     * @Route("/{id}/edit", name="anotacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Anotacion $anotacion)
    {
        $editForm = $this->createForm('App\Form\anotaciones\AnotacionType', $anotacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('anotacion_index');
        }

        return $this->render('App:anotaciones:edit.html.twig', array(
            'anotacion' => $anotacion,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a anotacion entity.
     *
     * @Route("/delete", name="anotacion_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$anotacion = $em->getRepository("App:Anotacion")->find($id);
            $em->remove($anotacion);
            $em->flush();
        

        return $this->redirectToRoute('anotacion_index');
    }
	
	/**
     * Indice de anotaciones sin clasificar
     *
     * @Route("/anotacion-sinclasificar", name="anotacion_sinclasificar")
     * @Method({"POST","GET"})
     */
	public function sinClasificarIndexAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$AnotacionRepository = $em->getRepository("App:Anotacion");
		$anotaciones = $AnotacionRepository->getAllAnotacionesSinClasificar();
		
		
		$anotacionCollection = new AnotacionCollection();
		
		foreach($anotaciones as $anotacion){
			
			//Busco la clasificacion que tiene el movimiento en la version provisional
			$clasificacion = $AnotacionRepository->getClasificacionFechaImporte($anotacion->getCuenta(),$anotacion->getFechaCargo(),$anotacion->getImporte());
			$anotacion->setClase($clasificacion['clase']);
			$anotacion->setSubclase($clasificacion['subclase']);
			$anotacion->setConcepto($clasificacion['concepto']);
			$anotacion->setAgrupacion($clasificacion['agrupacion']);
			$anotacion->setFormaPago($clasificacion['formaPago']);
			$anotacionCollection->getAnotaciones()->add($anotacion);
		}
		
		$form = $this->createForm('App\Form\anotaciones\AnotacionesCollectionType', $anotacionCollection);
		
		
		
		$form->handleRequest($request);

        if ($form->isSubmitted()) {
          $datos = $form->getData();
		  foreach($datos->getAnotaciones() as $anotacion){
			  if ($anotacion->getClase() !=null || $anotacion->getSubClase() != null ){
				$em->flush();
				$anotaciones = $AnotacionRepository->getAllAnotacionesSinClasificar();
				$anotacionCollection = new AnotacionCollection();
				foreach($anotaciones as $anotacion){
					$anotacionCollection->getAnotaciones()->add($anotacion);
				}
				$form = $this->createForm('App\Form\anotaciones\AnotacionesCollectionType', $anotacionCollection);

			  }
			  
		  }
		}
		
		
		
		
		return $this->render('App:anotaciones:edicionsinclasificar.html.twig', array(
            'formAnotaciones' => $form->createView(),
	    ));
	}

	
	/**
     * Indice de anotaciones sin clasificar
     *
     * @Route("/ajax-obtiene-subclases", name="ajax-obtiene-subclases")
     * @Method({"POST","GET"})
	 * 
     */
	
    public function ajaxFormAction(Request $request)
    {
		$idClase = $request->get('id');
		
		$em = $this->getDoctrine()->getManager();
		$subclases = $em->getRepository("App:Subclase")->getSubclases($idClase);
		
		
		$html="<option value='' selected='selected'>Seleccione una Subcategoria ...</option>";
		foreach ($subclases as $subclase){
			$html.="<option value='".$subclase->getId()."'>".$subclase->getDescripcion()."</option>";
		}
				
		
		 return new Response($html);
    }
	
	/**
     * Indice de anotaciones sin clasificar
     *
     * @Route("/ajax-obtiene-anotaciones", name="ajax-obtiene-anotaciones")
     * @Method({"POST","GET"})
	 * 
     */
	
    public function ajaxAnotacionesAction(Request $request)
    {
		$anyo = $request->get('anyo');
		$mes = $request->get('mes');
		$subclase = $request->get('subclase');
		$em = $this->getDoctrine()->getManager();
		$cuentaDefecto = $em->getRepository("App:Cuenta")->find(1);
		$anotaciones = $em->getRepository("App:Anotacion")->getAnotacionesMes($cuentaDefecto,$anyo,$mes,$subclase);
		
		$html="";
		
		foreach ($anotaciones as $anotacion){
			$descripcion = $anotacion->getConcepto();
			$fecha = $anotacion->getFechaCargo()->format('d-m-Y');
			$importe = $anotacion->getImporte();
			$html.="<tr><td class='centrado'>".$descripcion."</td><td class='centrado'>".$fecha."</td><td class='derecha'>".number_format($importe,2)."</td></tr>";
		}
				
		
		 return new Response($html);
    }
	
	
    
}
