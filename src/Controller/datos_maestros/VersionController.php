<?php

namespace App\Controller\datos_maestros;

use App\Entity\Cuenta;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Version;

/**
 * Version controller.{
 *
 * @Route("version")
 */
class VersionController extends Controller
{
    /** 
     * Lists all version entities.
    
     * @Route("/list/{numPag}", name="version_index")
     * @Method("GET")
     */
    public function indexAction($numPag = 1)
    {
        $em = $this->getDoctrine()->getManager();
		$VersionRepository = $em->getRepository("App:Version");
        $pageSize = $this->getParameter('numero_lineas');;
		$paginator = $VersionRepository->getPaginateVersiones($pageSize,$numPag);
		$totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $pageSize);

        return $this->render('App:datos_maestros:version/index.html.twig', array(
            'versiones' => $paginator,
			'pagesCount' => $pagesCount,
			'numPag' => $numPag
        ));
    }

    /**
     * Creates a new version entity.
     *
     * @Route("/new/", name="version_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $version = new Version();
        $form = $this->createForm('App\Form\datos_maestros\VersionType', $version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($version);
            $em->flush();

            return $this->redirectToRoute('version_index');
        }

        return $this->render('App:datos_maestros:version/edit.html.twig', array(
            'version' => $version,
            'form' => $form->createView(),
			'accion' => 'Nueva'
        ));
    }

    

    /**
     * Displays a form to edit an existing version entity.
     *
     * @Route("/{id}/edit", name="version_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cuenta $cuenta)
    {
        $editForm = $this->createForm('App\Form\datos_maestros\VersionType', $version);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('version_index');
        }

        return $this->render('App:datos_maestros:version/edit.html.twig', array(
            'version' => $version,
            'form' => $editForm->createView(),
            'accion' => 'Editar'
        ));
    }

    /**
     * Deletes a version entity.
     *
     * @Route("/delete", name="version_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
			$id = $request->query->get("id");
			$em = $this->getDoctrine()->getManager();
			$cuenta = $em->getRepository("App:Version")->find($id);
            $em->remove($version);
            $em->flush();
        

        return $this->redirectToRoute('version_index');
    }

    
}
