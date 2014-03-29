<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatoFacType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razonsocial')
            ->add('nif')
            ->add('direccion')
            ->add('poblacion')
            ->add('cp')
            ->add('cliente', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Cliente'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\DatosFacturacion'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_datosfactype';
    }
}
