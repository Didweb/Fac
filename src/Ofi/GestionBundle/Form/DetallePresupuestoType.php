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
            ->add('descripcion')
            ->add('precio')
            ->add('servicio')
            ->add('presupuesto', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Presupuesto'))

            
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
