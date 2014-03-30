<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Form\CorreoType;
use Ofi\GestionBundle\Entity\Empresa;
use Ofi\GestionBundle\Form\EmpresaType;

class CorreoController extends Controller
{




    public function nuevoAction($id)
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Correo();
        $idop= $em->getReference('OfiGestionBundle:Empresa', $id);
        $entity->setEmpresa($idop);
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
					->add('empresa',
					'Se ha creado un nuevo correo para esta empresa.');
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('empresa_error',
					'<b>Error</b>:  No se ha añadido el correo.'.$entity->getNombre().' / '.$entity->getMail().'<br />'.$entity->getBoletin().'<br />'.$entity->getCargo());
			}

		
      return $this->redirect($this->generateUrl(
						'ofi_gestion_editarempresa', 
						array('id' => $id)));
	
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
        ));
			
				
	}

}
