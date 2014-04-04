<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\DatosFacturacion;
use Ofi\GestionBundle\Form\DatoFacType;
use Ofi\GestionBundle\Form\DatoFacAdminType;
use Ofi\GestionBundle\Form\AdminConfigType;
use Ofi\GestionBundle\Entity\Empresa;
use Ofi\GestionBundle\Form\EmpresaType;

class DatoFacController extends Controller
{




    public function nuevoAction($id)
    {
		
		
		$em = $this->getDoctrine()->getManager();
		
		$total = $em->getRepository('OfiGestionBundle:DatosFacturacion')
               ->contarDatosFac($id);
	
		
		
        $entity = new DatosFacturacion();
        $idop= $em->getReference('OfiGestionBundle:Empresa', $id);
        $entity->setEmpresa($idop);
        $form   = $this->createForm(new DatoFacType(), $entity);
		
        
         return $this->render('OfiGestionBundle:DatoFac:crear.html.twig',
					array(	'entity' => $entity,
							'form_datosfac'   => $form->createView(),
							'total'=>(int)$total[0]['total'])
					);
					
    }



    public function nuevoAdminAction($id)
    {
		
		
		$em = $this->getDoctrine()->getManager();
		
		$total = $em->getRepository('OfiGestionBundle:DatosFacturacion')
               ->contarDatosFacAdmin($id);
	
		
		
        $entity = new DatosFacturacion();
        $idop= $em->getReference('OfiGestionBundle:AdminConfig', $id);
        $entity->setMiempresa($idop);
        $form   = $this->createForm(new DatoFacAdminType(), $entity);
		
        
         return $this->render('OfiGestionBundle:DatoFac:crearAdmin.html.twig',
					array(	'entity' => $entity,
							'form_datosfac'   => $form->createView(),
							'total'=>(int)$total[0]['total'])
					);
					
    }


  public function crearAction(Request $request,$id)
  {
	  
	$entity  = new DatosFacturacion();
    $form = $this->createForm(new DatoFacType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('empresa',
					'Se han introduicido los datos de facturación de este empresa');
		 
        }

		
      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $id)));
	
    }

  public function crearAdminAction(Request $request,$id)
  {
	  
	$entity  = new DatosFacturacion();
    $form = $this->createForm(new DatoFacAdminType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('empresa',
					'Se han introduicido los datos de facturación de este empresa');
		 
        }

		
      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarAdminConfig', 
						array('id' => $id)));
	
    }




	public function listarAction($id)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:DatosFacturacion')
				->findByEmpresa($id);

       return $this->render('OfiGestionBundle:DatoFac:listar.html.twig',
					array('entity' => $entity));
	}



    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

	public function listarAdminAction($id)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:DatosFacturacion')
				->findByMiempresa($id);

       return $this->render('OfiGestionBundle:DatoFac:listar.html.twig',
					array('entity' => $entity));
	}






	public function eliminarAction($id)
	{
	   $em 		= $this->getDoctrine()->getManager();
       $entity 	= $em->getRepository('OfiGestionBundle:DatosFacturacion')
					 ->find($id);	
		  		if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [eliminarAction.DatoFacController].'
            );
        }
		$idempresa	= $entity->getEmpresa()->getId();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('empresa_error',
						'Se han eliminado los datos de facturación.');
						
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


	public function eliminarAdminAction($id)
	{
	   $em 		= $this->getDoctrine()->getManager();
       $entity 	= $em->getRepository('OfiGestionBundle:DatosFacturacion')
					 ->find($id);	
		  		if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [eliminarAction.DatoFacController].'
            );
        }
		$idempresa	= $entity->getMiempresa()->getId();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('empresa_error',
						'Se han eliminado los datos de facturación.');
						
		$entity = $em->getRepository('OfiGestionBundle:AdminConfig')
				->find($idempresa);
		$editForm = $this->createForm(new AdminConfigType(), $entity);

        return $this->render('OfiGestionBundle:AdminConfig:edit.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()					
        ));
			
				
	}


}
