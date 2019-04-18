<?php

namespace App\Controller\datos_maestros;

use App\Entity\Agrupacion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Agrupacion controller.{
 *
 * @Route("agrupacion")
 */
class AgrupacionController extends Controller
{
    /** 
     * Lists all agrupacion entities.
    
     * @Route("/list/{numPag}", name="agrupacion_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
	$AgrupacionRepository = $em->getRepository("App:Agrupacion");
        $pageSize = $this->getParameter('numero_lineas');;
	$paginator = $AgrupacionRepository->getPaginateAgrupaciones($pageSize,$numPag);
	$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:agrupacion/index.html.twig', array(
            'agrupaciones' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new agrupacion entity.
     *
     * @Route("/new/", name="agrupacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agrupacion = new Agrupacion();
        $form = $this->createForm('App\Form\datos_maestros\AgrupacionType', $agrupacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agrupacion);
            $em->flush();

            return $this->redirectToRoute('agrupacion_index');
        }

        return $this->render('App:datos_maestros:agrupacion/edit.html.twig', array(
            'agrupacion' => $agrupacion,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    

    /**
     * Displays a form to edit an existing agrupacion entity.
     *
     * @Route("/{id}/edit", name="agrupacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agrupacion $agrupacion)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\AgrupacionType', $agrupacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agrupacion_index');
        }

        return $this->render('App:datos_maestros:agrupacion/edit.html.twig', array(
            'version' => $agrupacion,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a agrupacion entity.
     *
     * @Route("/delete", name="agrupacion_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
        $session = $request->getSession();
	$id = $request->query->get("id");
       
	$em = $this->getDoctrine()->getManager();
        if ($em->getRepository("App:Agrupacion")->AnotacionInAgrupacion($id)) {
            $session->getFlashBag()->add('error', 'No se puede borrar esta Agrupacion porque tiene Anotaciones asociadas');
	} else {
            $agrupacion = $em->getRepository("App:Agrupacion")->find($id);
            $em->remove($agrupacion);
            $em->flush();
        }

        return $this->redirectToRoute('agrupacion_index');
    }

    
}
