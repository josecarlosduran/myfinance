<?php

// src/Form/EventListener/AddNameFieldSubscriber.php
namespace App\Form\eventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityRepository;


class AddFieldSubclaseSubcriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
	
	
	
	public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }
	
	
	private function generaSubclases($form,$clase){
		$form->add($this->factory->createNamed('subclase',entityType::class, null, array(
            'class'         => 'App:Subclase',
            'auto_initialize' => false,
			
			'choice_label' => 'descripcion',
			'placeholder' => 'Seleccione una Subcategoria ...',
			'query_builder' => function (EntityRepository $repository) use ($clase) {
                $qb = $repository->createQueryBuilder('subclase')
						->where('subclase.clase = :clase')
						->orderBy('subclase.descripcion', 'ASC')
						->setParameter('clase', $clase);
                return $qb;
            }
        )));

	}
	
	
    public function preSetData(FormEvent $event)
    {
        $anotacion = $event->getData();
        $form = $event->getForm();
		$clase = $anotacion->getClase();
		$this->generaSubclases($form, $clase);
       
    }
}