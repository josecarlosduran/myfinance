<?php

namespace App\Form\importacion;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ImportacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion',TextType::class,array('required'=>'required','attr'=>array("class"=>"form-control")))
		        ->add('adjunto', FileType::class,array('mapped'=>false,'attr'=>array("class"=>"form-control")))				
				->add('esquema', EntityType::class,array('class'=>'App:EsquemaImportacion',
												'query_builder' => function (EntityRepository $er) {
													return $er->createQueryBuilder('e')
													->orderBy('e.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'placeholder' => 'Seleccione una Esquema de importacion ...',
												'required' =>true,
												'mapped' => false))
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Importacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_importacion';
    }


}
