<?php

namespace Classmarkets\RavenBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Classmarkets\RavenBundle\DependencyInjection\Compiler\RecorderCompilerPass;

class CMRavenBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->setParameter(
            'twig.exception_listener.class',
            'Classmarkets\RavenBundle\ExceptionListener'
        );

        $container->addCompilerPass(new RecorderCompilerPass());
    }


}
