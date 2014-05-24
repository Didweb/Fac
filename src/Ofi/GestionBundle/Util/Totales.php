<?php
namespace Ofi\GestionBundle\Util;


use Doctrine\ORM\EntityManager;

class Totales
{

	private $idFactura;
	private $TipoFactura;
	private $RetencionIrpf;
	private $TotalDetalles;
	private $FechaFactura;
	private $IVA;
	private $IVAsubtotal;
	private $IRPF;
	private $IRPFsubtotal;
	
	
	
	
	public function total($entidad)
	{
		$this->idFactura = $entidad->getId();
		$this->FechaFactura = $entidad->getFecha()->format('d-m-Y');
		$this->TipoFactura = $entidad->getTipofactura();
		
		foreach ($entidad->getDetalles() as $nom){
			echo "<br /> id: ".$nom->getId()." -> Precio: ".$nom->getPrecio();
			}
		
		echo "<br /> Id Factura = ".$this->idFactura;
		echo "<br /> Fecha Factura = ".$this->FechaFactura;
		echo "<br /> Tipo de  Factura = ".$this->TipoFactura;
	}
	

	
	
}
