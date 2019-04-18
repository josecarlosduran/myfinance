<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
class FormaPagoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
		        ->add('tipo', EntityType::class,array('class'=>'App:TipoFormaPago',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('t')
													->orderBy('t.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione un tipo ...',
												'required' =>true))
				->add('cuenta', EntityType::class,array('class'=>'App:Cuenta',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('c')
													->where('c.cuentaAhorro = 0')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una cuenta ...',
												'required' =>false))
				->add('plancargo', EntityType::class,array('class'=>'App:PlanCargo',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('p')
													->orderBy('p.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione un Plan de Cargo ...',
												'required' =>false))
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\FormaPago'
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
