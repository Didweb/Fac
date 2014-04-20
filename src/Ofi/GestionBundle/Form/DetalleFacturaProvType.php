<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class DetalleFacturaProvType extends AbstractType 
{
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', 'textarea', array(
											'attr' => array(
														'class' => 'tinymce',
														'data-theme' => 'advanced') 
														))
            ->add('precio')
            ->add('servicio')
            ->add('factura', 'entity_id', array(
											'class' => 'Ofi\GestionBundle\Entity\Factura'))
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
        return 'ofi_gestionbundle_detallefacturaprovtype';
    }
}
