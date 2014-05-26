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
	private $container;
	private $alertaIva = '';
	private $alertaIrpf = '';
	
	public function __construct($container)
	{
		$this->container = $container;
	}
	
	public function total($entidad)
	{
		$this->idFactura 	= $entidad->getId();
		$this->FechaFactura = $entidad->getFecha()->format('d-m-Y');
		$this->TipoFactura 	= $entidad->getTipofactura();
		$this->IVA			= $this->getIva($entidad->getFecha()->format('Y-m-d')); 
		$this->IRPF			= $this->getIva($entidad->getFecha()->format('Y-m-d'));
		
		
		$SumaSubtotal = 0;
		foreach ($entidad->getDetalles() as $nom){
			$SumaSubtotal = $SumaSubtotal + $nom->getPrecio();
			}
		
		
		
		$this->IVAsubtotal 	= ($SumaSubtotal * $this->IVA)/100;
		$this->IRPFsubtotal = ($SumaSubtotal * $this->IRPF)/100;
		
		$totalFactura		= ($this->IVAsubtotal + $SumaSubtotal)-$this->IRPFsubtotal;
		return $totales = array(
						'idfactura'		=> $this->idFactura,
						'subtotal'		=> $SumaSubtotal,
						'subtotaliva' 	=> $this->IVAsubtotal,
						'subtotalirpf' 	=> $this->IRPFsubtotal,
						'totalfactura'	=> $totalFactura,
						'alertaIva'		=> $this->alertaIva,
						'alertaIrpf'	=> $this->alertaIrpf
						);
	}
	

	public function getIva($fecha)
	{
		$container = $this->container;
		$entity = $container->get("doctrine")
							->getRepository('OfiGestionBundle:Iva')
							->BuscaIvas($fecha);
						
		if(!isset($entity[0])){
			$iva = 0;
			$this->alertaIva = 'No se ha definido un % de IVA para esta fecha.'; }
			else{
			$iva = $entity[0]->getPorcentaje();}
		
		return $iva ;
	}


	public function getIrpf($fecha)
	{
		$container = $this->container;
		$entity = $container->get("doctrine")
							->getRepository('OfiGestionBundle:Irpf')
							->BuscaIrpfs($fecha);
						
		if(!isset($entity[0])){
			$iva = 0;
			$this->alertaIrpf = 'No se ha definido un % de IRPF para esta fecha.'; }
			else{
			$iva = $entity[0]->getPorcentaje();}
		
		return $iva ;
	}
	
}
