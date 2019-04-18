<?php

namespace App\Controller\datos_maestros;

use App\Entity\Clase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Clase controller.{
 *
 * @Route("categoria")
 */
class CategoriaController extends Controller {

	/**
	 * Lists all clase entities.

	 * @Route("/list/{numPag}", name="clase_index")
	 * @Method("GET")
	 */
	public function indexAction($numPag = 1) {
		$em = $this->getDoctrine()->getManager();
		$ClaseRepository = $em->getRepository("App:Clase");
		$pageSize = $this->getParameter('numero_lineas');
		
		$paginator = $ClaseRepository->getPaginateClases($pageSize, $numPag);
		$totalItems = count($paginator);
		$pagesCount = ceil($totalItems / $pageSize);

		return $this->render('App:datos_maestros:clase/index.html.twig', array(
					'clases' => $paginator,
					'pagesCount' => $pagesCount,
					'numPag' => $numPag
		));
	}

	/**
	 * Creates a new clase entity.
	 *
	 * @Route("/new/", name="clase_new")
	 * @Method({"GET", "POST"})
	 */
	public function newAction(Request $request) {
		$session = $request->getSession();

		$clase = new Clase();
		$form = $this->createForm('App\Form\datos_maestros\ClaseType', $clase);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($clase);
			$em->flush();

			$session->getFlashBag()->add('success', 'Clase creada correctamente');

			return $this->redirectToRoute('clase_index');
		}

		return $this->render('App:datos_maestros:clase/edit.html.twig', array(
					'clase' => $clase,
					'form' => $form->createView(),
					'accion' => 'Nueva'
		));
	}

	/**
	 * Displays a form to edit an existing clase entity.
	 *
	 * @Route("/{id}/edit", name="clase_edit")
	 * @Method({"GET", "POST"})
	 */
	public function editAction(Request $request, Clase $clase) {
		$session = $request->getSession();

		$editForm = $this->createForm('App\Form\datos_maestros\ClaseType', $clase);
		$editForm->handleRequest($request);

		if ($editForm->isSubmitted() && $editForm->isValid()) {
			$this->getDoctrine()->getManager()->flush();
			$session->getFlashBag()->add('success', 'Clase editada correctamente');
			return $this->redirectToRoute('clase_index');
		}

		return $this->render('App:datos_maestros:clase/edit.html.twig', array(
					'clase' => $clase,
					'form' => $editForm->createView(),
					'accion' => 'Editar'
		));
	}

	/**
	 * Deletes a clase entity.
	 *
	 * @Route("/delete", name="clase_delete")
	 * @Method("GET")
	 */
	public function deleteAction(Request $request) {
		$id = $request->query->get("id");
		$session = $request->getSession();

		$em = $this->getDoctrine()->getManager();
		if ($em->getRepository("App:Clase")->SubclaseInClase($id)) {
			$session->getFlashBag()->add('error', 'No se puede borrar esta Categoria porque tiene SubCategorias asociadas');
		} else {
			$clase = $em->getRepository("App:Clase")->find($id);
			$em->remove($clase);
			$em->flush();
			$session->getFlashBag()->add('success', 'Clase borrada correctamente');
		}

		return $this->redirectToRoute('clase_index');
	}

}
