<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class PresupuestoType extends AbstractType 
{

	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array(
					'invalid_message'            => 'Error en la fecha.',
					'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
				   'required' => false,
				   'widget'   => 'single_text',
					'format' => 'ddMMyyyy'))
            ->add('nombre')
            ->add('texto')
            ->add('proyecto', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Proyecto'))

            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Presupuesto'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_presupuestotype';
    }
}
