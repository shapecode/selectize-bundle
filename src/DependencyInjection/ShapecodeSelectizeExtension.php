<?php

namespace Shapecode\Bundle\SelectizeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class ShapecodeSelectizeExtension
 * @package Shapecode\Bundle\SelectizeBundle\DependencyInjection
 * @author Nikita Loges
 */
class ShapecodeSelectizeExtension extends Extension implements PrependExtensionInterface
{

    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
//        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
//        $loader->load('services.yml');
    }

    /**
     * @inheritDoc
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('twig', [
            'form_themes' => [
                'ShapecodeSelectizeBundle:Form:form.html.twig'
            ]
        ]);
    }
}
