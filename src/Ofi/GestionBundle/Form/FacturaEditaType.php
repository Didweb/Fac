<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class FacturaEditaType extends AbstractType 
{
	
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array(
					'invalid_message'            => 'Fecha incompleta.',
					'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
				   'required' => false,
				   'widget'   => 'single_text',
					'format' => 'ddMMyyyy'))
            ->add('nfactura')
            ->add('empresa')
            ->add('tipofactura', 'choice', array(
					'choices'   => array('1' => '... para un cliente ...', '0' => '... de un proveedor ...'),
					'required'  => true));
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Factura'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_facturatype';
    }
}
