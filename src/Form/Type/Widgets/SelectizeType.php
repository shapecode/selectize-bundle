<?php

namespace Shapecode\Bundle\SelectizeBundle\Form\Type\Widgets;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class SelectizeType
 *
 * @package Shapecode\Bundle\SelectizeBundle\Form\Type\Widgets
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SelectizeType extends AbstractType
{

    /** @var ObjectManager */
    protected $em;

    /** @var RouterInterface */
    protected $router;

    /**
     * @param ObjectManager   $em
     * @param RouterInterface $router
     */
    public function __construct(ObjectManager $em, RouterInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * @inheritDoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['multiple'] = $options['multiple'];
        $view->vars['remote_url'] = $options['remote_url'];
        $view->vars['allow_create'] = $options['allow_create'];
        $view->vars['create_url'] = $options['create_url'];
        $view->vars['page_limit'] = $options['page_limit'];
        $view->vars['choices'] = $options['choices'];
        $view->vars['placeholder'] = $options['placeholder'];
        $view->vars['allow_empty'] = $options['allow_empty'];
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'placeholder'   => '',
            'allow_empty'   => true,
            'compound'      => false,
            'multiple'      => false,
            'remote_url'    => null,
            'remote_route'  => null,
            'remote_params' => [],
            'allow_create'  => false,
            'create_url'    => null,
            'create_route'  => null,
            'create_params' => [],
            'page_limit'    => 10,
            'choices'       => []
        ]);

        $resolver->setRequired([
            'remote_url'
        ]);

        $resolver->setNormalizer('remote_url', function (Options $options, $value) {
            if (!is_null($value)) {
                return $value;
            }

            return $this->router->generate($options['remote_route'], $options['remote_params']);
        });

        $resolver->setNormalizer('create_url', function (Options $options, $value) {
            if (!$options['allow_create']) {
                return $value;
            }

            if (!is_null($value)) {
                return $value;
            }

            return $this->router->generate($options['create_route'], $options['create_params']);
        });
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

}
