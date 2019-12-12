<?php

namespace Classmarkets\RavenBundle\Tests;

use Classmarkets\RavenBundle\Twig\SentryEventExtension;
use Classmarkets\RavenBundle\SentryEventRecorder;
use Twig\Test\IntegrationTestCase;

class TwigExtensionTest extends IntegrationTestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function getExtensions()
    {
        $recorder = \Mockery::mock(SentryEventRecorder::class);
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
