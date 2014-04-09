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



	public function editarAction($idpresupuesto)
	{
	  $entity = new Detalle();	
	  $em = $this->getDoctrine()->getManager();
      $idpro= $em->getReference('OfiGestionBundle:Presupuesto', $idpresupuesto);
	  $entity->setPresupuesto($idpro);						
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
		  		
		$idpresupuesto	= $entity->getPresupuesto();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('presupuesto_error',
						'Se ha eliminado un detalle del presupuesto.');
						
		$entityPre 	= $em->getRepository('OfiGestionBundle:Presupuesto')
					 ->find($idpresupuesto);

      return $this->render('OfiGestionBundle:Presupuesto:editar.html.twig',
			array('entity' => $entityPre,
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


	
}	
