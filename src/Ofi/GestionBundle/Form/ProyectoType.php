<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('fechainicio', 'date', array(
					'invalid_message'            => 'Error en la fecha.',
					'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
				   'required' => false,
				   'widget'   => 'single_text',
					'format' => 'ddMMyyyy'))
            ->add('fechafinal', 'date', array(
					'invalid_message'            => 'Error en la fecha.',
					'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Día'),
				   'required' => false,
				   'widget'   => 'single_text',
					'format' => 'ddMMyyyy'))
            ->add('empresa', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Empresa'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Proyecto'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_proyectotype';
    }
}
