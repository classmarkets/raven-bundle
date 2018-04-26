<?php

namespace Classmarkets\RavenBundle\Tests;

use Classmarkets\RavenBundle\Twig\SentryEventExtension;

class TwigExtensionTest extends \Twig_Test_IntegrationTestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function getExtensions()
    {
        $recorder = \Mockery::mock('Classmarkets\RavenBundle\SentryEventRecorder');
        $recorder->shouldReceive('getEventIdForException')->andReturn('abc');

        return [
            new SentryEventExtension($recorder),
        ];
    }

    /**
     * @codeCoverageIgnore This method is called in eval'd code
     */
    public function getFixturesDir()
    {
        return __DIR__.'/TwigFixtures';
    }
}
