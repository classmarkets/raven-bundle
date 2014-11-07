<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    private $configFilename;

    public function __construct($env, $debug, $configFilename)
    {
        parent::__construct($env, $debug);

        $this->configFilename = $configFilename;

        $this->cacheDir = $cacheDir = tempnam(sys_get_temp_dir(), 'raven-bundle-test');
        unlink($cacheDir);

        register_shutdown_function(function () use ($cacheDir) {
            $fs = new Filesystem();
            $fs->remove($cacheDir);
        });
    }

    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),

            new \Classmarkets\RavenBundle\CMRavenBundle(),
        );
    }

    public function getCacheDir()
    {
        return $this->cacheDir;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->configFilename);
    }
}
