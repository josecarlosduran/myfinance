<?php

namespace App\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * EsquemaImportacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EsquemaImportacionRepository extends \Doctrine\ORM\EntityRepository
{
	public function getPaginateEsquemasImportacion($tamanyo = 3,$paginaActual = 1){
        $em=$this->getEntityManager();
               
        $dql = "SELECT e FROM App\Entity\EsquemaImportacion e JOIN e.cuenta c ORDER BY e.descripcion ASC ";
        $query = $em->createQuery($dql)
                               ->setFirstResult($tamanyo * ($paginaActual - 1))
                               ->setMaxResults($tamanyo);
 
        $paginator = new Paginator($query, $fetchJoinCollection = true);
 
        return $paginator;
    }
}
