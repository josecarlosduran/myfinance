<?php

namespace App\Form\anotaciones;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use App\Form\anotaciones\AnotacionType;

class AnotacionesCollectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('anotaciones', CollectionType::class, array(
            'entry_type' => AnotacionType::class,
            'entry_options' => array('label' => false,'disableFields'=>true),
			))
			->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\AnotacionCollection'
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
