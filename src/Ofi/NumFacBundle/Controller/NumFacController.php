<?php

namespace Ofi\NumFacBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NumFacController extends Controller
{
	private $formato;
	private $ultimoN;
	
	
	public function getFormato()
	{
		return $this->formato;
	}
	
	public function setUltimoN($ultimoN)
	{
		return $this->ultimoN = $ultimoN;	
	}
	
	public function getUltimoN()
	{
		return $this->ultimoN;
	}
		

}
