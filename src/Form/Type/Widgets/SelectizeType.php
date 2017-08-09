<?php

namespace Shapecode\Bundle\SelectizeBundle\Form\Type\Widgets;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SelectizeType
 *
 * @package Shapecode\Bundle\SelectizeBundle\Form\Type\Widgets
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SelectizeType extends AbstractType
{

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->resetViewTransformers();
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'multiple' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'selectize';
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

}
