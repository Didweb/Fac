<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ofi\GestionBundle\Entity\Cliente;
use Ofi\GestionBundle\Form\ClienteType;


class ClienteController extends Controller
{


  public function crearAction(Request $request)
  {
	$entity  = new Cliente();
    $form = $this->createForm(new ClienteType(), $entity);
    $form->bind($request);

    if ($form->isValid()) {
		
		$em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
		$this->get('session')->getFlashBag()
						->add('cliente',
						'Se ha creado un nuevo cliente en el sistema');
						
        return $this->redirect($this->generateUrl(
						'ofi_gestion_editarcliente', 
						array('id' => $entity->getId())));
            
        }

		
       return $this->render('OfiGestionBundle:Cliente:crear.html.twig',
					array(	'entity' => $entity,
							'form'   => $form->createView())
					);
		
        
    }


	public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException(
            'Entidad no encontrada [editarAction.ClienteController].'
            );
        }

        $editForm = $this->createForm(new ClienteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('OfiGestionBundle:Cliente:editar.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


	/*
	 * Listamos lso clientes
	 * */
	public function listarAction()
	{
	  $em = $this->getDoctrine()->getManager();
      $entity = $em->getRepository('OfiGestionBundle:Cliente')
				->findAll();

        return $this->render('OfiGestionBundle:Cliente:listar.html.twig',
					array('entity' => $entity));
	}



    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
