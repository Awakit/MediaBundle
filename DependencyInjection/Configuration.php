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
                ->append($this->addLiipImagineNode())
            ->end()
        ->end();

        return $treeBuilder;
    }


    public function addLiipImagineNode()
    {
        $treeBuilder = new TreeBuilder();
        $liipNode = $treeBuilder->root('liip_imagine');

        $liipNode->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('resolvers')->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('default')->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('web_path')->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('cache_prefix')->defaultValue('toto/cache')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $liipNode;
    }
}