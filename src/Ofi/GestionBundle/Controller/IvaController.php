<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Iva;
use Ofi\GestionBundle\Form\IvaType;

class IvaController extends Controller
{




    public function nuevoAction()
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Iva();
        $form   = $this->createForm(new IvaType(), $entity);
		
        
         return $this->render('OfiGestionBundle:Iva:crear.html.twig',
					array(	'entity' 	=> $entity,
							'form_iva'  => $form->createView())
					);
    }



  public function crearAction(Request $request)
  {
	  
	$entity  = new Iva();
    $form = $this->createForm(new IvaType(), $entity);
    $form->bind($request);

	


    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('iva',
					'Se ha creado un concepto nuevo de IVA');
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('iva_error',
					'<b>Error</b>:  Se ha producido un error al crear el concepto nuevo de IVA.');
			}

		
      return $this->redirect($this->generateUrl('iva_listar'));
	
    }



	public function listarAction()
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Iva')
				->findAll();

       return $this->render('OfiGestionBundle:Iva:listar.html.twig',
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
	public function EliminarAction($id)
	{
	   $em 		= $this->getDoctrine()->getManager();
       $entity 	= $em->getRepository('OfiGestionBundle:Iva')
					 ->find($id);	
		  		
	
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('iva_error',
						'Se ha eliminado un concepto de IVA.');
						
		
		return $this->redirect($this->generateUrl('iva_listar'));
			
				
	}

}
