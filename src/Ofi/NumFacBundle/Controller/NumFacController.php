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


	public function setFormato($formato)
	{
		$this->formato = $formato;
		return $this->formato;
		
	}
	
	public function getFormato()
	{
		return $this->formato;
	}
	
	public function setUltimoN()
	{	
		$em = $GLOBALS['kernel']->getContainer()->get('doctrine')->getEntityManager();
        $entity = $em->getRepository('OfiGestionBundle:AdminConfig')->find('1');
        if (!$entity) {
            throw $this->createNotFoundException('Entidad no encontrada NumFac Controller -> setUltimoN.');
			}
		$nfac = $entity->getNumerofactura();
		$em->persist($entity);
		$em->flush();
		
		return $nfac;	
		
	}
	
	public function getUltimoN()
	{
		return $this->ultimoN = $this->setUltimoN();
	}


	public function setFormatoD()
	{
		
		$montamos = array();
		$separamos = str_split($this->formato);
		$res = array_count_values($separamos);
		foreach($res as $nom=>$val){
			$pos = strpos($this->formato,$nom);
			
				if($nom=='A'){
					$res =  $this->getTipoA($val);
				}elseif($nom=='N'){
					$res = $this->getTipoN($val);	
				}else{
					$res = $nom;	
				}
			$montamos[$pos+1] = $res;
			}
			
			ksort($montamos);
			$res = 	implode("", $montamos);
			$this->formatoD = $res;
		
			return $this->formatoD;
		
	}


	
	public function getFormatoD($formato)
	{	
		$this->setFormato($formato);
		$this->setFormatoD();
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
		$res = str_pad( $this->getUltimoN(), 
						 $posiciones, 
						 "0", STR_PAD_LEFT); 
		return  $res;					
	}


	
	public function indexAction()
	{
		$this->setFormato(15);
		
		
	    return $this->render('OfiNumFacBundle:NumFac:index.html.twig',
					array(	'res_formato' 	=> $this->getFormato(),
							'res_formatoD'  => $this->getFormatoD())
					);	
	}	

}
