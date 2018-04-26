<?php

namespace Classmarkets\RavenBundle\Tests;

use Classmarkets\RavenBundle\RecordingRavenClient;

class RecordingRavenClientTest extends \PHPUnit\Framework\TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testNotifiesRecorderViaCaptureException()
    {
        $exception = new \Exception();

        $realRavenClient = \Mockery::mock('Raven_Client');
        $realRavenClient
            ->shouldReceive('captureException')
            ->with($exception, array(), null, array())
            ->andReturn('123');
        $realRavenClient->shouldReceive('getIdent')->with('123')->andReturn('456');

        $recorder = \Mockery::mock('Classmarkets\RavenBundle\SentryEventRecorder');
        $recorder->shouldReceive('addExceptionEventId')->with($exception, '456');

        $ourRavenClient = new RecordingRavenClient($realRavenClient, $recorder);

        $eventId = $ourRavenClient->captureException($exception);
        $this->assertEquals('123', $eventId);
    }

    public function testDelegatesMethods()
    {
        $realRavenClient = \Mockery::mock('Raven_Client');
        $realRavenClient->shouldReceive('captureMessage')->once()->with('foobar');

        $recorder = \Mockery::mock('Classmarkets\RavenBundle\SentryEventRecorder');

        $ourRavenClient = new RecordingRavenClient($realRavenClient, $recorder);
        $ourRavenClient->captureMessage('foobar');
    }

    public function testInstanceOfOriginClient()
    {
        $realRavenClient = \Mockery::mock('Raven_Client');
        $recorder = \Mockery::mock('Classmarkets\RavenBundle\SentryEventRecorder');

        $ourRavenClient = new RecordingRavenClient($realRavenClient, $recorder);

        $this->assertInstanceOf('Raven_Client', $ourRavenClient);
    }
}
