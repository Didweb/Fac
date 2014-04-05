<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Ofi\GestionBundle\Entity\Factura;
use Ofi\GestionBundle\Form\FacturaType;

class FacturaController extends Controller
{

	


    public function nuevoAction()
    {
		$numf = $this->get('NumF');
		$formato = $this->container->getParameter('NumF.formatoFactura');
		$nf = $numf->getFormatoD($formato);
        
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Factura();
        $form   = $this->createForm(new FacturaType($nf), $entity);
		
        
         return $this->render('OfiGestionBundle:Factura:crear.html.twig',
					array(	'entity' => $entity,
							'form_factura'   => $form->createView()
							)
					);
    }



  public function crearAction(Request $request)
  {
	  
	$entity  = new Factura();
    $form = $this->createForm(new FacturaType(), $entity);
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
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('factura_error',
					'<b>Error</b>:  No se ha añadido la factura.');
			}

		
      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarfactura', 
						array('id' => $entity->getId())));
	
    }



	public function listarAction($id)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Correo')
				->findByEmpresa($id);

       return $this->render('OfiGestionBundle:Correo:listar.html.twig',
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
        

        $editForm = $this->createForm(new FacturaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
		
        
        return $this->render('OfiGestionBundle:Factura:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

}
