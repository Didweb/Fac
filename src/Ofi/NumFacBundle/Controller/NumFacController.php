<?php

namespace Ofi\NumFacBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ofi\GestionBundle\Entity\AdminConfig;

class NumFacController extends Controller
{
	private $formato;
	private $ultimoN;
	private $formatoD;
	private $tipos;
	
	
	public function setFormato()
	{
		return $this->formato = $this->container->getParameter('formatoFactura');
	}
	
	public function getFormato()
	{
		return $this->formato;
	}
	
	public function setUltimoN()
	{	
		$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('OfiGestionBundle:AdminConfig')->find(1);
        if (!$entity) {
            throw $this->createNotFoundException('Entidad no encontrada NumFac Controller -> setUltimoN.');
			}
		$nfac = $entity->getNumerofactura();
		$entity->setNumerofactura($nfac+1);
		$em->persist($entity);
		$em->flush();
		
		return $this->ultimoN = $nfac;	
		
	}
	
	public function getUltimoN()
	{
		return $this->ultimoN = $this->setUltimoN();
	}
	
	public function setFormatoD()
	{
		$montamos = array();
		$this->formatoD = $this->formato;
		foreach (count_chars($this->formatoD, 1) as $i => $val) {
				
				$pos = strpos($this->formatoD,  chr($i));

				if(chr($i)=='A'){
					$res = $this->getTipoA($val);
					}elseif(chr($i)=='N'){
					$res = $this->getTipoN($val);	
					}else{
					$res = chr($i);	
					}	
				
				$montamos[$pos+1] = $res;
				}
			ksort($montamos);	
			return $this->formatoD = implode("", $montamos);
		
	}
	
	public function getFormatoD()
	{
		return $this->formatoD;
	}	



	public function getTipoA($posiciones)
	{
		$fecha = new \DateTime('NOW');
		$posibles = array(
						'2' =>  $fecha->format('y'),
						'4' =>  $fecha->format('Y'),
						);
		if(!isset($posibles[$posiciones]))	{
			$posiciones= 4;
			}
			
		return $posibles[$posiciones];							
	}

	public function getTipoN($posiciones)
	{
		return  str_pad( $this->setUltimoN(), 
						 $posiciones, 
						 "0", STR_PAD_LEFT);					
	}


	
	public function indexAction()
	{
		$this->setFormato();
		$this->setFormatoD();
		
		
	    return $this->render('OfiNumFacBundle:NumFac:index.html.twig',
					array(	'res_formato' 	=> $this->getFormato(),
							'res_formatoD'  => $this->getFormatoD())
					);	
	}	

}
