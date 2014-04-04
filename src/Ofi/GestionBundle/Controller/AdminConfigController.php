<?php

namespace Ofi\GestionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ofi\GestionBundle\Entity\AdminConfig;
use Ofi\GestionBundle\Form\AdminConfigType;

/**
 * AdminConfig controller.
 *
 */
class AdminConfigController extends Controller
{

    public function editarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:AdminConfig')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AdminConfig entity.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('OfiGestionBundle:AdminConfig:edit.html.twig', array(
            'id' 		  => $id,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }



    private function createEditForm(AdminConfig $entity)
    {
        $form = $this->createForm(new AdminConfigType(), $entity, array(
            'action' => $this->generateUrl('ofi_gestion_updateAdminConfig', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }


    public function updateAction(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OfiGestionBundle:AdminConfig')->find($id);
                if (!$entity) {
            throw $this->createNotFoundException('Entidad n encontrada AdminCOnfig en update.');
        }
		$editForm = $this->createForm(new AdminConfigType(), $entity);
		$editForm->bind($request);
		
		$em->persist($entity);
        $em->flush();

		
        
        return $this->render('OfiGestionBundle:AdminConfig:edit.html.twig',
			array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'tipo'		  => $entity->getTipo()	
            ));
    }
   
}
