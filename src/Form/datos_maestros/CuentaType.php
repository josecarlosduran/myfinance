<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class CuentaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('IBAN',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
		        ->add('cuentaAhorro', CheckboxType::class, array('label'=> '¿Es cuenta de ahorro?','required' => false,))
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Cuenta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_clase';
    }


}
