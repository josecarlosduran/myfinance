<?php

namespace App\Controller\datos_maestros;

use App\Entity\EsquemaImportacion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * EsquemaImportacion controller.{
 *
 * @Route("esquemaimportacion")
 */
class EsquemaImportacionController extends Controller
{
    /** 
     * Lists all esquemaimportacions entities.
    
     * @Route("/list/{numPag}", name="esquemaimportacion_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$EsquemaImportacionRepository = $em->getRepository("App:EsquemaImportacion");
        $pageSize = $this->getParameter('numero_lineas');;
		$paginator = $EsquemaImportacionRepository->getPaginateEsquemasImportacion($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:esquemaimportacion/index.html.twig', array(
            'esquemasimportacion' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new esquemaimportacion entity.
     *
     * @Route("/new/", name="esquemaimportacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$allCuentas= $em->getRepository("App:Cuenta")->getAllCuentas();
		
		$esquemaimportacion = new EsquemaImportacion();
        $form = $this->createForm('App\Form\datos_maestros\EsquemaImportacionType', $esquemaimportacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($esquemaimportacion);
            $em->flush();

            return $this->redirectToRoute('esquemaimportacion_index');
        }

        return $this->render('App:datos_maestros:esquemaimportacion/edit.html.twig', array(
            'cuentas' => $allCuentas,
			'esquemaimportacion' => $esquemaimportacion,
            'form' => $form->createView(),
			'accion' => 'Nuevo'
        ));
    }

    

    /**
     * Displays a form to edit an existing esquemaimportacion entity.
     *
     * @Route("/{id}/edit", name="esquemaimportacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EsquemaImportacion $esquemaimportacion)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\EsquemaImportacionType', $esquemaimportacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('esquemaimportacion_index');
        }

        return $this->render('App:datos_maestros:esquemaimportacion/edit.html.twig', array(
            'esquemaimportacion' => $esquemaimportacion,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a esquemaimportacion entity.
     *
     * @Route("/delete", name="esquemaimportacion_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$esquemaimportacion = $em->getRepository("App:EsquemaImportacion")->find($id);
            $em->remove($esquemaimportacion);
            $em->flush();
        

        return $this->redirectToRoute('esquemaimportacion_index');
    }

    
}
