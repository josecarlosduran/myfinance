<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class PlanCargoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('diaInicial1',NumberType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('diaFinal1',NumberType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('diaCargo1',NumberType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('incrementoMes1',NumberType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('diaInicial2',NumberType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('diaFinal2',NumberType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('diaCargo2',NumberType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('incrementoMes2',NumberType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
		        ->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\PlanCargo'
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
