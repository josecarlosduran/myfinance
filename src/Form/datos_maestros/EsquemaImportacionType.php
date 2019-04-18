<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Doctrine\ORM\EntityRepository;
class EsquemaImportacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
		        ->add('cuenta', EntityType::class,array('class'=>'App:Cuenta',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una cuenta ...',
												'required' =>true))
				->add('lineasCabecera',NumberType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('separadorCampos',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('puntoDecimal',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
				->add('separadorMiles',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))										
				->add('inversionSigno', CheckboxType::class, array('label'=> '¿Inversion de Signo?','required' => false,))
				->add('formatoFecha', ChoiceType::class,array('choices'  => array(
																	'd/m/Y' => 'd/m/Y',
																	'm/d/Y' => 'm/d/Y',
																	'Y/m/d' => 'Y/m/D',
																	'd-m-Y' => 'd-m-Y',
																	'm-d-Y' => 'm-d-Y',
																	'Y-m-d' => 'Y-m-d'),
																	))
				
				->add('campo1',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo2',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo3',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo4',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo5',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo6',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo7',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo8',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo9',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('campo10',TextType::class,array('required'=>false,'attr'=>array("class"=>"form-control")))
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\EsquemaImportacion'
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
