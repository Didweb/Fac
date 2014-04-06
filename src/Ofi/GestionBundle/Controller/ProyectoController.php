<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Proyecto;
use Ofi\GestionBundle\Form\ProyectoType;
use Ofi\GestionBundle\Entity\Empresa;

class ProyectoController extends Controller
{


	public function listarAction($idempresa)
	{
	$em 	= $this->getDoctrine()->getManager();
	$entity = $em->getRepository('OfiGestionBundle:Proyecto')
					 ->ListaProyectosEmpresa($idempresa);
					 
	return $this->render('OfiGestionBundle:Proyecto:listar.html.twig',
					array('entity' => $entity));				 
	}

	
	public function nuevoAction($idempresa)
	{
	 $em 	= $this->getDoctrine()->getManager();
	 	
	 $entity = new Proyecto();
	 $idem = $em->getReference('OfiGestionBundle:Empresa', $idempresa);
     $entity->setEmpresa($idem);
     $form   = $this->createForm(new ProyectoType(), $entity);
     
	return $this->render('OfiGestionBundle:Proyecto:nuevo.html.twig',
					array(	'entity' => $entity,
							'form_proyecto'   => $form->createView())
					);
	
	}


    public function crearAction(Request $request, $id)
    {
	$entity  = new Proyecto();
    $form = $this->createForm(new ProyectoType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
						->add('empresa',
						'Se ha añadido un nuevo proyecto a la empresa.');
						
        return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $entity->getEmpresa()->getId())));
            
        }

		
        return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $entity->getEmpresa()->getId())));
		
     } 



	public function eliminarAction($idproyecto,$ok)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Proyecto')
						->find($idproyecto);	
		
	  if($ok=='no'){
		  
		 return $this->render(
					'OfiGestionBundle:Proyecto:eliminar.html.twig',
					array('entity' => $entity,'ok'=>'no'));
		  
		  }elseif($ok=='si'){
		$nombreeliminado = $entity->getNombre();	  		
		
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('empresa_error',
						'Se ha eliminado este proyecto:<br /> <b>'.
						$nombreeliminado.'</b>.');
						
			
							
       return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $entity->getEmpresa()->getId())));
			
			}		
	}



	public function editarAction($idproyecto)
	{
	return $this->render('OfiGestionBundle:Proyecto:editar.html.twig',
					array('id'=>$idproyecto)
					);	
	}	

}
