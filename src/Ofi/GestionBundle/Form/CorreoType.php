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
            ->add('cargo','text',array('required'=>false))
            ->add('boletin','checkbox',array('required'=>false))
            ->add('empresa', 'entity_id', array(
            'class' => 'Ofi\GestionBundle\Entity\Empresa'))
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
