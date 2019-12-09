<?php

namespace Classmarkets\RavenBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Classmarkets\RavenBundle\ExceptionListener;

class CMRavenExtension extends Extension
{
    /**
     * {@inheritdoc}
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
            $container->setParameter('twig.exception_listener.class', ExceptionListener::class);
        }
    }
}
