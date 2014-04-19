<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Ofi\GestionBundle\Entity\Presupuesto;
use Ofi\GestionBundle\Entity\Detalle;
use Ofi\GestionBundle\Form\PresupuestoType;
use Ofi\GestionBundle\Form\DetallePresupuestoType;


class PresupuestoController extends Controller
{
	
	
	public function listadoProAction($idproyecto)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Presupuesto')
						->findByProyecto($idproyecto);					

       return $this->render('OfiGestionBundle:Presupuesto:listarPro.html.twig',
					array('entity' => $entity));
		
	}
	

	public function listadoDetallePreAction($idpresupuesto)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Detalle')
						->findByPresupuesto($idpresupuesto);
				

       return $this->render('OfiGestionBundle:Presupuesto:listarDetallePre.html.twig',
					array('entity' => $entity));
		
	}


	public function nuevoAction($idproyecto)
	{
	  $entity = new Presupuesto();	
	  $em = $this->getDoctrine()->getManager();
      $idpro= $em->getReference('OfiGestionBundle:Proyecto', $idproyecto);
	  $entity->setProyecto($idpro);						
	  $form   = $this->createForm(new PresupuestoType(), $entity);					


       return $this->render('OfiGestionBundle:Presupuesto:crear.html.twig',
					array('entity' => $entity,
						  'form_pre'   => $form->createView()));
		
	}

  public function crearAction(Request $request,$id,$editpre='si')
  {
	  
	$entity  = new Presupuesto();
    $form = $this->createForm(new PresupuestoType(), $entity);
    $form->bind($request);

	


    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		
        $em->persist($entity);
        $em->flush();
        $idpresupuesto 	= $entity->getId();
        $idproyecto 	= $entity->getProyecto()->getId();
		$this->get('session')->getFlashBag()
					->add('proyecto',
					'Se ha creado un nuevo presupuesto para este proyecto.');
		 
		
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('proyecto_error',
					'<b>Error</b>:  No se ha añadido el presupuesto.');
			}


      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarpresupuesto', 
						array(	'idproyecto' => $idproyecto,
								'editpre'	 => $editpre,
								'idpresupuesto'=> $idpresupuesto )));
	
    }



	public function editarAction($idpresupuesto,$idproyecto)
	{
	  $entity = new Detalle();	
	  $em = $this->getDoctrine()->getManager();
      $idpres= $em->getReference('OfiGestionBundle:Presupuesto', $idpresupuesto);
      $idproy= $em->getReference('OfiGestionBundle:Presupuesto', $idproyecto);
	  $entity->setPresupuesto($idpres);		
	  $entity->setProyecto($idproy);					
	  $form   = $this->createForm(new DetallePresupuestoType(), $entity);					


       return $this->render('OfiGestionBundle:Presupuesto:editar.html.twig',
					array('entity' => $entity,
						  'form_detallepre'   => $form->createView()));
		
	}



	public function eliminarDetalleAction($id)
	{
	   $em 		= $this->getDoctrine()->getManager();
       $entity 	= $em->getRepository('OfiGestionBundle:Detalle')
					 ->find($id);	
		  		
		$idpresupuesto = $entity->getPresupuesto()->getId();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('presupuesto_error',
						'Se ha eliminado un detalle del presupuesto.');
						
	  $entity = new Detalle();	
	  $em = $this->getDoctrine()->getManager();
      $idpro= $em->getReference('OfiGestionBundle:Presupuesto', $idpresupuesto);
	  $entity->setPresupuesto($idpro);						
	  $form   = $this->createForm(new DetallePresupuestoType(), $entity);	

      return $this->render('OfiGestionBundle:Presupuesto:editar.html.twig',
					array('entity' => $entity,
						  'form_detallepre'   => $form->createView()));
			
				
	}


	public function creardetalleAction(Request $request)
	{
	$entity  = new Detalle();
    $form = $this->createForm(new DetallePresupuestoType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		
        $em->persist($entity);
        $em->flush();
        $idpresupuesto 	= $entity->getId();
        $idproyecto 	= $entity->getPresupuesto()->getProyecto()->getId();
		$this->get('session')->getFlashBag()
					->add('presupuesto',
					'Se ha creado un nuevo detalle  para este presupuesto.');
		 
		
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('presupuesto_error',
					'<b>Error</b>:  No se ha añadido el detalle del presupuesto.');
			}


       return $this->render('OfiGestionBundle:Presupuesto:editar.html.twig',
					array('entity' => $entity,
						  'form_detallepre'   => $form->createView()));
		
	}

	public function eliminarAction($idpresupuesto,$ok)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Presupuesto')
						->find($idpresupuesto);	
		
	  if($ok=='no'){
		  
		 return $this->render(
					'OfiGestionBundle:Presupuesto:eliminar.html.twig',
					array('entity' => $entity,'ok'=>'no'));
		  
		  }elseif($ok=='si'){
		$nombreeliminado = $entity->getNombre();	  		
		
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('proyecto_error',
						'Se ha eliminado este presupuesto:<br /> <b>'.
						$nombreeliminado.'</b>.');
						
			
							
       return $this->redirect($this->generateUrl(
						'ofi_gestion_editarproyecto', 
						array('idproyecto' => $entity->getProyecto()->getId())));
			
			}		
	}
	
	public function editarFormAction($idpresupuesto)
	{
		$em 	= $this->getDoctrine()->getManager();
		$entity = $em->getRepository('OfiGestionBundle:Presupuesto')
						->find($idpresupuesto);
		$form = $this->createForm(new PresupuestoType(), $entity);
		
		return $this->render('OfiGestionBundle:Presupuesto:editarFormulario.html.twig',
					array(	'entity'	=> $entity,
							'formulario_presupuesto'   => $form->createView())
					);	
	}
	
	
	public function editarelpresupuestoAction(Request $request,$idpresupuesto)
	{
		$em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('OfiGestionBundle:Presupuesto')
						->find($idpresupuesto);
		$form = $this->createForm(new PresupuestoType(), $entity);
		$form->bind($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($entity);
			$em->flush();
			$this->get('session')->getFlashBag()
						->add('presupuesto',
						'Se han editado los datos de este presupuesto.');
						
					}else{
			$this->get('session')->getFlashBag()
						->add('presupuesto_error',
						'NO se han podido editar  este presupeusto.');			
						
						}
		$entity = new Detalle();	
		$em = $this->getDoctrine()->getManager();
		$idpro= $em->getReference('OfiGestionBundle:Presupuesto', $idpresupuesto);
		$entity->setPresupuesto($idpro);						
		$form   = $this->createForm(new DetallePresupuestoType(), $entity);
					
		return $this->render('OfiGestionBundle:Presupuesto:editar.html.twig',
					array(	'entity'	=> $entity,
							'id'		=> $idpresupuesto,
							'form_detallepre'   => $form->createView())
					);	
	}
	
}	
