<?php

namespace App\Controller\datos_maestros;

use App\Entity\FormaPago;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * FormaPago controller.{
 *
 * @Route("formapago")
 */
class FormaPagoController extends Controller
{
    /** 
     * Lists all formapagos entities.
    
     * @Route("/list/{numPag}", name="formapago_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$FormaPagoRepository = $em->getRepository("App:FormaPago");
        $pageSize = $this->getParameter('numero_lineas');;
		$paginator = $FormaPagoRepository->getPaginateFormasPago($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:formapago/index.html.twig', array(
            'formapagos' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new formapago entity.
     *
     * @Route("/new/", name="formapago_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$allCuentas= $em->getRepository("App:Cuenta")->getAllCuentas();
		$allPlanesCargo= $em->getRepository("App:PlanCargo")->getAllPlanesCargo();
		
		$formapago = new FormaPago();
        $form = $this->createForm('App\Form\datos_maestros\FormaPagoType', $formapago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formapago);
            $em->flush();

            return $this->redirectToRoute('formapago_index');
        }

        return $this->render('App:datos_maestros:formapago/edit.html.twig', array(
            'cuentas' => $allCuentas,
			'planescargo' => $allPlanesCargo,
			'formapago' => $formapago,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    

    /**
     * Displays a form to edit an existing formapago entity.
     *
     * @Route("/{id}/edit", name="formapago_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormaPago $formapago)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\FormaPagoType', $formapago);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formapago_index');
        }

        return $this->render('App:datos_maestros:formapago/edit.html.twig', array(
            'formapago' => $formapago,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a formapago entity.
     *
     * @Route("/delete", name="formapago_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$formapago = $em->getRepository("App:FormaPago")->find($id);
            $em->remove($formapago);
            $em->flush();
        

        return $this->redirectToRoute('formapago_index');
    }

    
}
