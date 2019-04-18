<?php

namespace App\Controller\importacion;

use App\Entity\Cuenta;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Importacion;
use App\Entity\Version;
use App\Entity\Anotacion;
use App\clases\general\Fecha;
use App\clases\general\Fichero;
use League\Csv\Reader;

/**
 * Importacion controller.{
 *
 * @Route("importacion")
 */
class ImportacionController extends Controller
{
    /**
     * Lists all cuenta entities.

     * @Route("/list/{numPag}", name="importacion_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$CuentaRepository = $em->getRepository("App:Importacion");
        $pageSize = $this->getParameter('numero_lineas');
		$paginator = $CuentaRepository->getPaginateImportaciones($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:importacion:index.html.twig', array(
            'importaciones' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new importacion entity.
     *
     * @Route("/new/", name="importacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fecha = new Fecha();
		$importacion = new Importacion();
        $form = $this->createForm('App\Form\importacion\ImportacionType', $importacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

			$em = $this->getDoctrine()->getManager();
            $importacion->setFechaCarga($fecha);
			$adjunto = $form['adjunto']->getData();
			$esquema = $form['esquema']->getData();

			$em->persist($importacion);
            $em->flush();

			$fichero = new Fichero($adjunto);
			$ruta=$fichero->moverDefinitivo('importaciones');
			$datos = $this->extraerDatos($ruta, $esquema);
			$version = $em->getRepository('App:Version')->find(1);
			$cuenta = $esquema->getCuenta();

			$numRegistros=0;
			foreach ($datos as $dato){
				if($dato['fechaGasto'])
        {
  				$fechaGasto = new Fecha();
  				$fecha = $fechaGasto->createFromFormat($dato['formatoFecha'], $dato['fechaGasto']);

  				$nuevaAnotacion = new Anotacion();
  				$nuevaAnotacion->setConcepto("");
  				$nuevaAnotacion->setConceptoBanco(substr($dato['conceptoBanco'],0,250));
  				$nuevaAnotacion->setVersion($version);
  				$nuevaAnotacion->setImporte(str_replace($dato['puntoDecimal'], '.', str_replace($dato['separadorMiles'],'',$dato['importe'])));
  				$nuevaAnotacion->setSaldoBancario(str_replace($dato['puntoDecimal'], '.', str_replace($dato['separadorMiles'],'',$dato['saldoBancario'])));

  				$nuevaAnotacion->setFechaGasto($fecha);
  				$nuevaAnotacion->setFechaCargo($fecha);
  				$nuevaAnotacion->setCuenta($cuenta);
  				$nuevaAnotacion->setImportacion($importacion);
  				$em->persist($nuevaAnotacion);
                  $em->flush();
  				$numRegistros++;
      }
      }
			$importacion->setNumeroRegistros($numRegistros);
			$em->persist($importacion);
            $em->flush();

            return $this->redirectToRoute('importacion_index');
        }

        return $this->render('App:importacion:edit.html.twig', array(
            'importacion' => $importacion,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }



    /**
     * Deletes a cuenta entity.
     *
     * @Route("/delete", name="importacion_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");

			$em = $this->getDoctrine()->getManager();
			$importacion = $em->getRepository("App:Importacion")->find($id);
			$em->remove($importacion);
            $em->flush();


        return $this->redirectToRoute('importacion_index');
    }

    private function extraerDatos($fichero,$esquema){
		$reader = Reader::createFromPath($fichero, 'r');

		$reader->setDelimiter($esquema->getSeparadorCampos());
		$reader->setOffset($esquema->getLineasCabecera()+1);

		$lineas = $reader->fetch();
		$datos = array();
		foreach ($lineas as $linea) {
			$registro = array();


			if ($esquema->getCampo1()!=null) $registro[$esquema->getCampo1()] = $linea[0];
			if ($esquema->getCampo2()!=null) $registro[$esquema->getCampo2()] = $linea[1];
			if ($esquema->getCampo3()!=null) $registro[$esquema->getCampo3()] = $linea[2];
			if ($esquema->getCampo4()!=null) $registro[$esquema->getCampo4()] = $linea[3];
			if ($esquema->getCampo5()!=null) $registro[$esquema->getCampo5()] = $linea[4];
			if ($esquema->getCampo6()!=null) $registro[$esquema->getCampo6()] = $linea[5];
			if ($esquema->getCampo7()!=null) $registro[$esquema->getCampo7()] = $linea[6];
			if ($esquema->getCampo8()!=null) $registro[$esquema->getCampo8()] = $linea[7];
			if ($esquema->getCampo9()!=null) $registro[$esquema->getCampo9()] = $linea[8];
			if ($esquema->getCampo10()!=null) $registro[$esquema->getCampo10()] = $linea[9];
			$registro['formatoFecha'] = $esquema->getFormatoFecha();
			$registro['puntoDecimal'] = $esquema->getPuntoDecimal();
			$registro['separadorMiles'] = $esquema->getSeparadorMiles();

			array_push($datos, $registro);
		}
        return $datos;
	}
}
