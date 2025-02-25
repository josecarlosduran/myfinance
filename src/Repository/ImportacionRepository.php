<?php

namespace App\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ImportacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImportacionRepository extends \Doctrine\ORM\EntityRepository
{
	public function getPaginateImportaciones($tamanyo = 3,$paginaActual = 1){
        $em=$this->getEntityManager();
               
        $dql = "SELECT i FROM App\Entity\Importacion i ORDER BY i.descripcion ASC ";
        $query = $em->createQuery($dql)
                               ->setFirstResult($tamanyo * ($paginaActual - 1))
                               ->setMaxResults($tamanyo);
 
        $paginator = new Paginator($query, $fetchJoinCollection = true);
 
        return $paginator;
    }
}
