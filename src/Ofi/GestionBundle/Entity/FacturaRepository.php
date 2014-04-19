<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FacturaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FacturaRepository extends EntityRepository
{
	
	public function ListadoFacProyecto($idproyecto)
	{
	return $this->getEntityManager()
            ->createQuery('SELECT f FROM 
						  OfiGestionBundle:Factura f
						  WHERE f.proyecto = :idproyecto ')
            ->setParameter('idproyecto',$idproyecto)
            ->getResult();
		
	}
	
	
}
