<?php

namespace App\Form\datos_maestros;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
class SubclaseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
		        ->add('clase', EntityType::class,array('class'=>'App:Clase',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una clase ...',
												'required' =>true))
				->add('cuenta', EntityType::class,array('class'=>'App:Cuenta',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una contra cuenta ...',
												'required' =>false))
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Subclase'
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
