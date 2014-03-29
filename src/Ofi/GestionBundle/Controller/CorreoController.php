<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Form\CorreoType;
use Ofi\GestionBundle\Entity\Cliente;
use Ofi\GestionBundle\Form\ClienteType;

class CorreoController extends Controller
{




    public function nuevoAction($id)
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Correo();
        $idop= $em->getReference('OfiGestionBundle:Cliente', $id);
        $entity->setCliente($idop);
        $form   = $this->createForm(new CorreoType(), $entity);
		
        
         return $this->render('OfiGestionBundle:Correo:crear.html.twig',
					array(	'entity' => $entity,
							'form_correo'   => $form->createView())
					);
    }



  public function crearAction(Request $request,$id)
  {
	  
	$entity  = new Correo();
    $form = $this->createForm(new CorreoType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('cliente',
					'Se ha creado un nuevo correo para este cliente.');
		 
        }

		
      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarcliente', 
						array('id' => $id)));
	
    }



	public function listarAction($id)
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Correo')
				->findByCliente($id);

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
		  		
		$idcliente	= $entity->getCliente();
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('cliente_error',
						'Se ha eliminado un correo de este cliente.');
						
		$entity = $em->getRepository('OfiGestionBundle:Cliente')
				->find($idcliente);
		$editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OfiGestionBundle:Cliente:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),					
        ));
			
				
	}

}