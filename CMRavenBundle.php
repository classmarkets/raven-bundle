<?php

namespace Classmarkets\RavenBundle;

use Classmarkets\RavenBundle\DependencyInjection\Compiler\AddRecorderCompilerPass;
use Classmarkets\RavenBundle\DependencyInjection\Compiler\TwigExceptionListenerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CMRavenBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddRecorderCompilerPass());
        $container->addCompilerPass(new TwigExceptionListenerCompilerPass());
    }
}
