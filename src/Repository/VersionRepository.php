<?php

namespace App\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * VersionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VersionRepository extends \Doctrine\ORM\EntityRepository
{
	
	public function getPaginateVersiones($tamanyo = 3,$paginaActual = 1){
        $em=$this->getEntityManager();
               
        $dql = "SELECT v FROM App\Entity\Version v ORDER BY v.descripcion ASC ";
        $query = $em->createQuery($dql)
                               ->setFirstResult($tamanyo * ($paginaActual - 1))
                               ->setMaxResults($tamanyo);
 
        $paginator = new Paginator($query, $fetchJoinCollection = true);
 
        return $paginator;
    }
	
	public function getAllVersiones(){
		$em=$this->getEntityManager();
        $dql = "SELECT v FROM App\Entity\Version v ORDER BY v.descripcion ASC ";
		$query = $em->createQuery($dql);
		return $query;
	}
	
}
