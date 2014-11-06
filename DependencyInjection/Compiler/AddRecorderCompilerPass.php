<?php

namespace Classmarkets\RavenBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddRecorderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('cm_raven.enable_exception_listener')) {
            $definition = $container->getDefinition('twig.exception_listener');
            $definition->addMethodCall('setRecorder', array(new Reference('cm_raven.sentry_event_recorder')));
        }
    }
}
