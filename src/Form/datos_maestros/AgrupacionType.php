<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AgrupacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
                ->add('fechaDesde', DateType::class, array(
							
							'input' => 'datetime',
							'widget' => 'single_text',
							'attr' => array('class'=>'calendar', 'read_only' => true)))
                ->add('fechaHasta', DateType::class, array(
							'required'=>false,
							'input' => 'datetime',
							'widget' => 'single_text',
							'attr' => array('class'=>'calendar', 'read_only' => true)))
		        ->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Agrupacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_agrupacion';
    }


}
