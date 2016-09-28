<?php

namespace Awakit\MediaBundle;

use Awakit\MediaBundle\Provider\Factory\ProviderCompilerPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AwakitMediaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        if (class_exists('Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass'))
            $container->addCompilerPass( DoctrineOrmMappingsPass::createAnnotationMappingDriver( array('Awakit\MediaBundle\Model') , array(realpath(__DIR__.DIRECTORY_SEPARATOR.'Model')) ));

        $container->addCompilerPass(new ProviderCompilerPass());

    }
}
