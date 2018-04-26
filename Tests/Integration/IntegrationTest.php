<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

class IntegrationTest extends \PHPUnit\Framework\TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @dataProvider getConfigurations */
    public function testErrorPage($config, $debug)
    {
        if (defined('HHVM_VERSION')) {
            $this->markTestSkipped('Skipping on hhvm (xml parsing in the framework bundle fails');
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
        foreach (glob(__DIR__ . '/configs/test*.yml') as $configFilename) {
            yield [$configFilename, $debug = true];
        }
    }
}
