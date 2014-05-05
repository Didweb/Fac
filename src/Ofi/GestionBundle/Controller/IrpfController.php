<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Irpf;
use Ofi\GestionBundle\Form\IrpfType;

class IrpfController extends Controller
{




    public function nuevoAction()
    {
		
		$em = $this->getDoctrine()->getManager();
        $entity = new Irpf();
        $form   = $this->createForm(new IrpfType(), $entity);
		
        
         return $this->render('OfiGestionBundle:Irpf:crear.html.twig',
					array(	'entity' 	=> $entity,
							'form_irpf'  => $form->createView())
					);
    }



  public function crearAction(Request $request)
  {
	  
	$entity  = new Irpf();
    $form = $this->createForm(new IrpfType(), $entity);
    $form->bind($request);

	


    if ($form->isValid()) {
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
					->add('irpf',
					'Se ha creado un concepto nuevo de IRPF');
		 
        }else{
			$this->get('session')->getFlashBag()
					->add('irpf_error',
					'<b>Error</b>:  Se ha producido un error al crear el concepto nuevo de IRPF.');
			}

		
      return $this->redirect($this->generateUrl('irpf_listar'));
	
    }



	public function listarAction()
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Irpf')
				->findAll();

       return $this->render('OfiGestionBundle:Irpf:listar.html.twig',
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
       $entity 	= $em->getRepository('OfiGestionBundle:Irpf')
					 ->find($id);	
		  		
	
		$em->remove($entity);
        $em->flush();
		
		$this->get('session')->getFlashBag()
						->add('irpf_error',
						'Se ha eliminado un concepto de IVA.');
						
		
		return $this->redirect($this->generateUrl('irpf_listar'));
			
				
	}

}
