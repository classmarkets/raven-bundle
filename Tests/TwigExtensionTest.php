<?php

namespace Classmarkets\RavenBundle\Tests;

use Classmarkets\RavenBundle\SentryEventExtension;

class TwigExtensionTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        $recorder = \Mockery::mock('Classmarkets\RavenBundle\SentryEventRecorder');
        $recorder->shouldReceive('getEventIdForException')->andReturn('abc');

        return array(
            new SentryEventExtension($recorder),
        );
    }

    public function getFixturesDir()
    {
        return __DIR__ . '/TwigFixtures';
    }
}
