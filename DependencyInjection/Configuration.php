<?php
/**
 * @author jgn
 * @date 09/09/2016
 * @description For ...
 */

namespace Awakit\MediaBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('awakit_media');

        $rootNode
            ->children()
                ->scalarNode('upload_folder')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}