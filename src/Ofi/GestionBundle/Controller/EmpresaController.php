<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Empresa;
use Ofi\GestionBundle\Form\EmpresaType;


class EmpresaController extends Controller
{


    public function nuevoAction()
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Empresa();
        $form   = $this->createForm(new EmpresaType(), $entity);
		
        
         return $this->render('OfiGestionBundle:Empresa:crear.html.twig',
					array(	'entity' => $entity,
							'form'   => $form->createView())
					);
    }




  public function crearAction(Request $request)
  {
	  
	$entity  = new Empresa();
    $form = $this->createForm(new EmpresaType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
						->add('empresa',
						'Se ha creado un nuevo empresa en el sistema');
						
        return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $entity->getId())));
            
        }

		
       return $this->render('OfiGestionBundle:Empresa:crear.html.twig',
					array(	'entity' => $entity,
							'form'   => $form->createView())
					);
		
        
    }


	public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
		
		
        $entity = $em->getRepository('OfiGestionBundle:Empresa')
						->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [editarAction.EmpresaController].'
            );
        }
        

        $editForm = $this->createForm(new EmpresaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
        
        return $this->render('OfiGestionBundle:Empresa:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'tipo'		  => $entity->getTipo()	
        ));
    }


    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:Empresa')->find($id);
		$editForm = $this->createForm(new EmpresaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		$editForm->bind($request);
		
		$em->persist($entity);
        $em->flush();

		
        
        return $this->render('OfiGestionBundle:Empresa:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'tipo'		  => $entity->getTipo()	
            ));
     }       

	/*
	 * Listamos los empresas
	 * */
	public function listarAction($filtro)
	{
	  $em = $this->getDoctrine()->getManager();
	  
	  if($filtro==2){
     
		$dql   = "SELECT e FROM OfiGestionBundle:Empresa e";
		$query = $em->createQuery($dql);	
				   
		}elseif($filtro==1 || $filtro==0){
		$query = $em->getRepository('OfiGestionBundle:Empresa')
					 ->ListaEmpresasFiltro($filtro);
			
			}		
		
		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
        $query, $this->get('request')
					 ->query->get('page', 1) ,30 
		);


       return $this->render('OfiGestionBundle:Empresa:listar.html.twig',
					array('pagination' => $pagination,	
						  'filtro' => $filtro	
							));
	}



    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }



	/*
	 * Eliminar
	 * */
	public function eliminarAction($id,$ok)
	{
	   $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Empresa')
						->find($id);	
		
	  if($ok=='no'){
		  
		 return $this->render(
					'OfiGestionBundle:Empresa:eliminar.html.twig',
					array('entity' => $entity,'ok'=>'no'));
		  
		  }elseif($ok=='si'){
		$nombreeliminado = $entity->getNombre().' '.
							$entity->getApellido().
							' <b>'.$entity->getNomsocial().'</b>';	  		
		
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('empresa_error',
						'Se ha eliminado el empresa:<br /> '.
						$nombreeliminado.'.');
						
		$entity = $em->getRepository('OfiGestionBundle:Empresa')
				->findAll();	
							
        return $this->render(
						'OfiGestionBundle:Empresa:listar.html.twig',
						array('entity' => $entity));
			
			}		
	}

}
