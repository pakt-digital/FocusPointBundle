<?php

namespace PaktDigital\FocusPointBundle\Form;

use PaktDigital\FocusPointBundle\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageFocusType extends AbstractType
{
    private $entity;

	private const X_KEY = 'x';

    private const Y_KEY = 'y';

    public function __construct($image_entity)
    {
        $this->entity = $image_entity;
    }

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('imageFile', VichImageType::class, [
				'label' => false
			])
			->add('x', HiddenType::class, [
				'required' => true,
				'mapped' => false
			])
			->add('y', HiddenType::class, [
				'required' => true,
				'mapped' => false
			]);

		$builder
			->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
				$data = $event->getData();
				$form = $event->getForm();

				$x = 0;
				$y = 0;

				if ($data instanceof Entity\ImageInterface) {
					$x = $data->getFocusPoint()[self::X_KEY];
					$y = $data->getFocusPoint()[self::Y_KEY];
                }

				$form->get(self::X_KEY)->setData($x);
				$form->get(self::Y_KEY)->setData($y);
			})
			->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
				$data = $event->getData();
				$form = $event->getForm();

				$data->setFocusPoint([
					self::X_KEY => $form->get(self::X_KEY)->getData(),
					self::Y_KEY => $form->get(self::Y_KEY)->getData()
				]);

				$event->setData($data);
			});
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => $this->entity
		]);
	}
}
