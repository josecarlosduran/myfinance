<?php

namespace App\Form\anotaciones;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
class AnotacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('conceptoBanco',TextType::class,array('disabled'=>true,'required'=>false,'attr'=>array("class"=>"form-control")))
				->add('concepto',TextType::class,array('disabled'=>false,'required'=>true,'attr'=>array("class"=>"form-control")))
		        ->add('clase', EntityType::class,array('class'=>'App:Clase',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una categoria ...',
												'required' =>!$options['disableFields']))
				->add('subclase', EntityType::class,array('class'=>'App:Subclase',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('s')
													->orderBy('s.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una Subcategoria ...',
												'required' =>!$options['disableFields']))
                                ->add('agrupacion', EntityType::class,array('class'=>'App:Agrupacion',
												'query_builder' => function (EntityRepository $er) {
                                                                                                        $fecha = new \DateTime();
                                                                                                        $hoy = $fecha->format("Y-m-d");
													return $er->createQueryBuilder('a')
                                                                                                        ->andWhere("a.fechaDesde<='$hoy'")
                                                                                                        ->andWhere("a.fechaHasta>='$hoy' OR a.fechaHasta IS NULL")
													->orderBy('a.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una Agrupacion de Gastos ...',
												'required' =>false))
				->add('fechaGasto', DateType::class, array(
							'disabled'=>$options['disableFields'],
							'input' => 'datetime',
							'widget' => 'single_text',
							'attr' => array('class'=>'calendar', 'read_only' => true)))
				->add('importe',MoneyType::class,array('disabled'=>$options['disableFields'],'required'=>true))
				->add('formaPago', EntityType::class,array('class'=>'App:FormaPago',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('fp')
													->orderBy('fp.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una Forma de Pago ...',
												'required' =>true))	
				
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Anotacion',
			'disableFields' => false
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
