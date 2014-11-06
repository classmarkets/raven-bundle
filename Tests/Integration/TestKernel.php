<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),

            new \Classmarkets\RavenBundle\CMRavenBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }

    /*
    public function getCacheDir()
    {
        return '/this/directory/cannot/possibly/exist,/right?';
    }
     */
}
