<?php

namespace App\Controller\datos_maestros;

use App\Entity\PlanCargo;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.{
 *
 * @Route("plancargo")
 */
class PlanCargoController extends Controller
{
    /** 
     * Lists all plancargo entities.
    
     * @Route("/list/{numPag}", name="plancargo_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$PlanCargoRepository = $em->getRepository("App:PlanCargo");
        $pageSize = $this->getParameter('numero_lineas');
		$paginator = $PlanCargoRepository->getPaginatePlanesCargo($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:plancargo/index.html.twig', array(
            'planesCargo' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new plancargo entity.
     *
     * @Route("/new/", name="plancargo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plancargo = new PlanCargo();
        $form = $this->createForm('App\Form\datos_maestros\PlanCargoType', $plancargo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plancargo);
            $em->flush();

            return $this->redirectToRoute('plancargo_index');
        }

        return $this->render('App:datos_maestros:plancargo/edit.html.twig', array(
            'plancargo' => $plancargo,
            'form' => $form->createView(),
			'accion' => 'Nuevo'
        ));
    }

    

    /**
     * Displays a form to edit an existing plancargo entity.
     *
     * @Route("/{id}/edit", name="plancargo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlanCargo $plancargo)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\PlanCargoType', $plancargo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plancargo_index');
        }

        return $this->render('App:datos_maestros:plancargo/edit.html.twig', array(
            'plancargo' => $plancargo,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a plancargo entity.
     *
     * @Route("/delete", name="plancargo_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$plancargo = $em->getRepository("App:PlanCargo")->find($id);
            $em->remove($plancargo);
            $em->flush();
        

        return $this->redirectToRoute('plancargo_index');
    }

    
}
