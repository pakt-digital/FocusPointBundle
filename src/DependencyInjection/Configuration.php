<?php

namespace PaktDigital\FocusPointBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('paktdigital_focus_point');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('image_entity')
                    ->defaultValue('App\Entity\Media\Image')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
