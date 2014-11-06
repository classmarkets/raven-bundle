<?php

namespace Classmarkets\RavenBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class CMRavenExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->getDefinition('cm_raven.raven_client')->setDecoratedService($config['client_id']);

        $enableExceptionListener = $config['enable_exception_listener'];
        $container->setParameter('cm_raven.enable_exception_listener', $enableExceptionListener);
        if ($enableExceptionListener) {
            $container->setParameter('twig.exception_listener.class', 'Classmarkets\RavenBundle\ExceptionListener');
        }
    }
}
