<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Servicio;
use Ofi\GestionBundle\Form\ServicioType;
use Ofi\GestionBundle\Entity\Empresa;

class ServicioController extends Controller
{


	public function listarAction()
	{
	$em = $this->getDoctrine()->getManager();	
	$dql   = "SELECT s FROM OfiGestionBundle:Servicio s";
	$query = $em->createQuery($dql);
	
	$paginator  = $this->get('knp_paginator');
	$pagination = $paginator->paginate(
    $query, $this->get('request')
					 ->query->get('page', 1) ,60 
		);
					 
	return $this->render('OfiGestionBundle:Servicio:listar.html.twig',
					array('pagination' => $pagination,));				 
	}

	
	public function nuevoAction()
	{
	 $em 	= $this->getDoctrine()->getManager();
	 	
	 $entity = new Servicio();
     $form   = $this->createForm(new ServicioType(), $entity);
     
	return $this->render('OfiGestionBundle:Servicio:nuevo.html.twig',
					array(	'entity' => $entity,
							'form_servicio'   => $form->createView())
					);
	
	}


    public function crearAction(Request $request)
    {
	$entity  = new Servicio();
    $form = $this->createForm(new ServicioType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
						->add('servicio',
						'Se ha añadido un nuevo servicio en el sistema.');
						
        }

		
        return $this->redirect($this->generateUrl(
						'ofi_gestion_editarservicio', 
						array('idservicio' => $entity->getId())));
		
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



	public function editarAction($idservicio)
	{
		
        $em = $this->getDoctrine()->getManager();
		$entity = $em->getRepository('OfiGestionBundle:Servicio')
						->find($idservicio);

        if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [editarAction.ServicioController].'
            );
        }
        

        $editForm = $this->createForm(new ServicioType(), $entity);
        $deleteForm = $this->createDeleteForm($idservicio);
		
        
        return $this->render('OfiGestionBundle:Servicio:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
	}	

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }


    public function actualizarAction(Request $request, $idservicio)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:Servicio')->find($idservicio);
		$editForm = $this->createForm(new ServicioType(), $entity);
        $deleteForm = $this->createDeleteForm($idservicio);
		$editForm->bind($request);
		
		$em->persist($entity);
        $em->flush();

		
        
        return $this->render('OfiGestionBundle:Servicio:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
            ));
     }   

}
