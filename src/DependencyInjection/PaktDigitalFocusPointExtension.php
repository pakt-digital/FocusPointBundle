<?php

namespace PaktDigital\FocusPointBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

class PaktDigitalFocusPointExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('PaktDigital\FocusPointBundle\Form\ImageFocusType');
        $definition->setArgument(0, $config['image_entity']);
    }

    public function getAlias(): string
    {
        return 'paktdigital_focus_point';
    }
}
