<?php
namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CorreoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mail')
            ->add('nombre')
            ->add('cargo')
            ->add('boletin')
            ->add('cliente', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Cliente'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Correo'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_correotype';
    }
}