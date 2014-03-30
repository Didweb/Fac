<?php

namespace Ofi\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('nomsocial','text',array('required'=>'false'))
            ->add('tipo','choice',array('choices' => array('1' => 'Cliente', '0' => 'Proveedor')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ofi\GestionBundle\Entity\Empresa'
        ));
    }

    public function getName()
    {
        return 'ofi_gestionbundle_empresatype';
    }
}
