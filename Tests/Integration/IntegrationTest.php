<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Yaml\Yaml;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider getConfigurations */
    public function testErrorPage($config, $debug)
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped("Skipping on hhvm (xml parsing in the framework bundle fails");
        }

        $env = uniqid(); // avoid re-declaring classes in the container dump
        $kernel = new TestKernel($env, $debug, $config);
        $kernel->boot();
        $client = $kernel->getContainer()->get('test.client');

        $client->request('GET', '/_cm_raven_bundle_test');

        $this->assertEquals("Error Code: abc\n", $client->getResponse()->getContent());
    }

    public function getConfigurations()
    {
        $configurations = array();

        foreach (glob(__DIR__ . '/configs/test*.yml') as $configFilename) {
            $configurations[] = array($configFilename, $debug = true);
            $configurations[] = array($configFilename, $debug = false);
        }

        return $configurations;
    }
}
