<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class FacturaType extends AbstractType 
{
	private $nf;
	private $tipofactura;
	
	public function __construct($nf,$tipofactura=0)
	{
		$this->nf = $nf;
		$this->tipofactura = $tipofactura;
	}
	
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'date', array(
					'invalid_message'            => 'Error en la fecha.',
					'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
				   'required' => false,
				   'widget'   => 'single_text',
					'format' => 'ddMMyyyy'))
            ->add('nfactura','text')
            ->add('empresa','entity', array(
				'empty_value' => 'Selecciona...',
				'class' => 'OfiGestionBundle:Empresa',
				'query_builder' => function(EntityRepository $er) {
						return $er->createQueryBuilder('e')
						->where('e.tipo = :tipo')
						->setParameter('tipo', 0)
						->orderBy('e.nombre', 'ASC');},))
            ->add('tipofactura', 'hidden', array( 'data'   => $this->tipofactura))
            
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
