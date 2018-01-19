<?php

namespace Classmarkets\RavenBundle\DependencyInjection\Compiler;

use Classmarkets\BaseBundle\Routing\Router;
use Classmarkets\RavenBundle\ExceptionListener;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwigExceptionListenerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $router = $container->findDefinition('twig.exception_listener');
        $router->setClass(ExceptionListener::class);
    }
}
