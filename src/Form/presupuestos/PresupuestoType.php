<?php

namespace App\Form\presupuestos;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\AnyoRepository;
use App\Repository\MesRepository;
use App\Repository\ClaseRepository;
use App\Repository\SubclaseRepository;


use Doctrine\ORM\EntityRepository;
class PresupuestoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$disabled = $options['modo'] == 'editar'?true:false;
		$builder->add('anyo', EntityType::class,array('class' =>'App:Anyo',
												'query_builder' => function (AnyoRepository $a) {
													return $a->createQueryBuilder('a')
													->Where('a.abierto = TRUE')
													->orderBy('a.anyo', 'DESC');
												},
												'choice_label' => 'anyo',
												'required' =>true,
												'disabled' =>$disabled))
				->add('meses', EntityType::class,array('class' =>'App:Mes',
												'query_builder' => function (MesRepository $m) {
													return $m->createQueryBuilder('m')
													->orderBy('m.id', 'ASC');
												},
												'expanded' => false,
												'multiple' => !$disabled,
												'disabled' => $disabled,
												'choice_label' => 'mes',
												'required' =>true))
				->add('clase', EntityType::class,array('class' =>'App:Clase',
												'query_builder' => function (ClaseRepository $c) {
													return $c->createQueryBuilder('c')
													->orderBy('c.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'required' =>true))
				->add('subclase', EntityType::class,array('class' =>'App:Subclase',
												'query_builder' => function (SubclaseRepository $s) {
													return $s->createQueryBuilder('s')
													->orderBy('s.descripcion', 'ASC');
												},
												'choice_label' => 'descripcion',
												'required' =>true))
				->add('importe',MoneyType::class,array('required'=>true))
				->add('unico', CheckboxType::class, array('label'=> '¿Cargo Unico?','required' => false,))										
				->add('Guardar', SubmitType::class,array('attr'=>array("class"=>"btn btn-success")));
		if ($options['modo'] == 'editar'){
			$builder->add('id', HiddenType::class, array());
		}
		
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('modo' => 'nuevo',
            
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'presupuesto';
    }


}
