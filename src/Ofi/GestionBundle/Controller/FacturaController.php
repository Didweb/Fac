<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Ofi\GestionBundle\Entity\Factura;
use Ofi\GestionBundle\Form\FacturaType;
use Ofi\GestionBundle\Form\FacturaEditaType;
use Ofi\GestionBundle\Form\FacturaProyType;

class FacturaController extends Controller
{
	
	private $nf;



	public function getNf()
	{
		$numf = $this->get('NumF');		
		$formato = $this->container->getParameter('NumF.formatoFactura');	
		$nf = $numf->getFormatoD($formato);
		return $this->nf=$nf;
		
	}

    public function nuevoProyectoAction($idempresa,$idproyecto)
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Factura();
        
		$idemp= $em->getReference('OfiGestionBundle:Empresa', $idempresa);
		$idpro= $em->getReference('OfiGestionBundle:Proyecto', $idproyecto);
		
		$entity->setEmpresa($idemp);
		$entity->setProyecto($idpro);
		
        $form   = $this->createForm(new FacturaProyType($this->getNf()), $entity);
		
        
        return $this->render('OfiGestionBundle:Factura:crearFaProy.html.twig',
					array(	'entity' => $entity,
							'form_factura'   => $form->createView(),
							'idproyecto'	=> $idproyecto,
							'idempresa'		=> $idempresa
							)
					);
    }


    public function nuevoAction()
    {
		
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Factura();
        $form   = $this->createForm(new FacturaType($this->getNf()), $entity);
		
        
         return $this->render('OfiGestionBundle:Factura:crear.html.twig',
					array(	'entity' => $entity,
							'form_factura'   => $form->createView()
							)
					);
    }



  public function crearAction(Request $request)
  {
	  
	  	$this->numf = $this->get('NumF');
		$nf = $this->numf->getFormatoD($this->getNf());
	  
	$entity  = new Factura();
    $form = $this->createForm(new FacturaType($nf), $entity);
    $form->bind($request);


    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
		$tipo = $entity->getEmpresa()->getTipo();
		$entity->setTipofactura($tipo);
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('factura',
					'Se ha creado una nueva factura.');
		
		$entityNF = $em->getRepository('OfiGestionBundle:AdminConfig')
						->find(1);
		$ulNF = $entityNF->getNumerofactura();				
		$entityNF->setNumerofactura($ulNF+1);
		$em->persist($entityNF);
		$em->flush();
		
		return $this->redirect($this->generateUrl(
						'ofi_gestion_editarfactura', 
						array('id' => $entity->getId())));
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('factura_error',
					'<b>Error</b>:  No se ha añadido la factura.');
			}

		
       return $this->render('OfiGestionBundle:Factura:crear.html.twig',
					array(	'entity' => $entity,
							'form_factura'   => $form->createView())
					);
	
    }



  public function crearFacProyAction(Request $request,$idproyecto,$idempresa,$editpre = "no")
  {
	  
		$em = $this->getDoctrine()->getManager();
		
	  	$this->numf = $this->get('NumF');
		$nf = $this->numf->getFormatoD($this->getNf());
	  
		$entity  = new Factura();
		
		$idemp= $em->getReference('OfiGestionBundle:Presupuesto', $idempresa);
		$entity->setEmpresa($idemp);
		
		$form = $this->createForm(new FacturaProyType($nf), $entity);
		$form->bind($request);


    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('factura',
					'Se ha creado una nueva factura para este proyecto.');
		
		$entityNF = $em->getRepository('OfiGestionBundle:AdminConfig')
						->find(1);
		$ulNF = $entityNF->getNumerofactura();				
		$entityNF->setNumerofactura($ulNF+1);
		$em->persist($entityNF);
		$em->flush();
		

		 
		 
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('proyecto_error',
					'<b>Error</b>:  No se ha añadido la factura.');
			}

		
		
		$entity2 = $em->getRepository('OfiGestionBundle:Proyecto')->find($idproyecto);	
				
		return $this->render('OfiGestionBundle:Proyecto:editar.html.twig',
					array(	'entity'	=> $entity2,
							'id'		=> $idproyecto,
							'editpre'	=> $editpre)
					);			
	
    }




	public function listarAction()
	{
	  $em = $this->getDoctrine()->getManager();
      $dql   = "SELECT f FROM OfiGestionBundle:Factura f";
	  $query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
        $query, $this->get('request')
					 ->query->get('page', 1) ,30 
		);

       return $this->render('OfiGestionBundle:Factura:listar.html.twig',
					array('pagination' => $pagination));
	}



	public function listadoProAction($idproyecto)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Factura')
						->ListadoFacProyecto($idproyecto);	

       return $this->render('OfiGestionBundle:Factura:listarPro.html.twig',
					array('entity' => $entity));
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
	public function eliminarAction($id)
	{
	   $em 		= $this->getDoctrine()->getManager();
       $entity 	= $em->getRepository('OfiGestionBundle:Correo')
					 ->find($id);	
		  		
		$idempresa	= $entity->getEmpresa();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('empresa_error',
						'Se ha eliminado un correo de este empresa.');
						
		$entity = $em->getRepository('OfiGestionBundle:Empresa')
				->find($idempresa);
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


	public function editarAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('OfiGestionBundle:Factura')
						->find($id);


        if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [editarAction.FacturaController].'
            );
        }
        
        $editForm = $this->createForm(new FacturaEditaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
        return $this->render('OfiGestionBundle:Factura:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }


    public function actualizarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:Factura')->find($id);
		$editForm = $this->createForm(new FacturaEditaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		$editForm->bind($request);
		
		$em->persist($entity);
        $em->flush();

		
        
        return $this->render('OfiGestionBundle:Factura:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()	
            ));
     }    


}
