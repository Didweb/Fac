<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class FacturaProyType extends AbstractType 
{
	private $nf;
	
	public function __construct($nf)
	{
		$this->nf = $nf;
	}
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array(
											'invalid_message'	 => 'Error en la fecha.',
											'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
										    'required' => false,
										    'widget'   => 'single_text',
											'format' => 'ddMMyyyy'))
            ->add('nfactura','text',array('data'=>$this->nf))
            ->add('empresa', 'entity_id', array(
												'class' => 'Ofi\GestionBundle\Entity\Empresa'))
            ->add('proyecto', 'entity_id', array(
												'class' => 'Ofi\GestionBundle\Entity\Proyecto'))
            ->add('tipofactura', 'hidden', array('data'=>'1'))
            
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
        return 'ofi_gestionbundle_facturaproytype'; 
    }
}
