<?php

namespace Classmarkets\RavenBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RecorderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('twig.exception_listener');
        $definition->addMethodCall('setRecorder', array(new Reference('cm_raven.sentry_event_recorder')));
    }
}
