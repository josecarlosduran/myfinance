<?php

namespace App\Controller\datos_maestros;

use App\Entity\Subclase;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subcategoria controller.{
 *
 * @Route("subcategoria")
 */
class SubcategoriaController extends Controller
{
    /** 
     * Lists all subclases entities.
    
     * @Route("/list/{numPag}", name="subclase_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$SubclaseRepository = $em->getRepository("App:Subclase");
        $pageSize = $this->getParameter('numero_lineas');;
		$paginator = $SubclaseRepository->getPaginateSubclases($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:subclase/index.html.twig', array(
            'subclases' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new subclase entity.
     *
     * @Route("/new/", name="subclase_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$allClases= $em->getRepository("App:Clase")->getAllClases();
		
		$subclase = new Subclase();
        $form = $this->createForm('App\Form\datos_maestros\SubclaseType', $subclase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subclase);
            $em->flush();

            return $this->redirectToRoute('subclase_index');
        }

        return $this->render('App:datos_maestros:subclase/edit.html.twig', array(
            'clases' => $allClases,
			'subclase' => $subclase,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    

    /**
     * Displays a form to edit an existing subclase entity.
     *
     * @Route("/{id}/edit", name="subclase_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subclase $subclase)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\SubclaseType', $subclase);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subclase_index');
        }

        return $this->render('App:datos_maestros:subclase/edit.html.twig', array(
            'subclase' => $subclase,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a subclase entity.
     *
     * @Route("/delete", name="subclase_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$subclase = $em->getRepository("App:Subclase")->find($id);
            $em->remove($subclase);
            $em->flush();
        

        return $this->redirectToRoute('subclase_index');
    }

    
}
