<?php

namespace App\Controller\datos_maestros;

use App\Entity\Cuenta;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.{
 *
 * @Route("cuenta")
 */
class CuentaController extends Controller
{
    /** 
     * Lists all cuenta entities.
    
     * @Route("/list/{numPag}", name="cuenta_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$CuentaRepository = $em->getRepository("App:Cuenta");
        $pageSize = $this->getParameter('numero_lineas');;
		$paginator = $CuentaRepository->getPaginateCuentas($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:cuenta/index.html.twig', array(
            'cuentas' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new cuenta entity.
     *
     * @Route("/new/", name="cuenta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cuenta = new Cuenta();
        $form = $this->createForm('App\Form\datos_maestros\CuentaType', $cuenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cuenta);
            $em->flush();

            return $this->redirectToRoute('cuenta_index');
        }

        return $this->render('App:datos_maestros:cuenta/edit.html.twig', array(
            'cuenta' => $cuenta,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    

    /**
     * Displays a form to edit an existing cuenta entity.
     *
     * @Route("/{id}/edit", name="cuenta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cuenta $cuenta)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\CuentaType', $cuenta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cuenta_index');
        }

        return $this->render('App:datos_maestros:cuenta/edit.html.twig', array(
            'cuenta' => $cuenta,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a cuenta entity.
     *
     * @Route("/delete", name="cuenta_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$cuenta = $em->getRepository("App:Cuenta")->find($id);
            $em->remove($cuenta);
            $em->flush();
        

        return $this->redirectToRoute('cuenta_index');
    }

    
}
