<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class DetallePresupuestoType extends AbstractType 
{

	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'textarea', array(
				'attr' => array(
					'class' => 'tinymce',
					'data-theme' => 'advanced' 
				) ))
            ->add('precio')
            ->add('servicio')
            ->add('presupuesto', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Presupuesto'))
            ->add('proyecto', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Proyecto'))

            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Detalle'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_detallepresupuestotype';
    }
}
