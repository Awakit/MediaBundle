<?php

namespace Awakit\MediaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AwakitMediaExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('provider.yml');
        $loader->load('doctrine.yml');
        $loader->load('form.yml');
        $loader->load('twig.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('awakit.media.upload_folder', $config['upload_folder']);

    }

}
