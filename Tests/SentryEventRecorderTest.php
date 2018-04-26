<?php

namespace Classmarkets\RavenBundle\Tests;

use Classmarkets\RavenBundle\SentryEventRecorder;

class SentryEventRecorderTest extends \PHPUnit\Framework\TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testStoreAndRetrieveEventId()
    {
        $recorder = new SentryEventRecorder();
        $exception = new \Exception();
        $recorder->addExceptionEventId($exception, 'abc');

        $this->assertEquals('abc', $recorder->getEventIdForException($exception));
    }

    public function testRetrieveAllIds()
    {
        $recorder = new SentryEventRecorder();

        $e = new \Exception();
        $recorder->addExceptionEventId($e, 'abc');
        $recorder->addExceptionEventId($e, 'abc'); // yes, twice.

        $e = new \Exception();
        $recorder->addExceptionEventId($e, 'def');

        $this->assertEquals(['abc', 'def'], $recorder->getAllEventIds());
    }

    public function testIgnoresNonObjects()
    {
        $recorder = new SentryEventRecorder();
        $nonObject = 'some string';
        $recorder->addExceptionEventId($nonObject, 'abc');

        $this->assertEquals(null, $recorder->getEventIdForException('some string'));
    }

    public function testIgnoresUnknownObjects()
    {
        $recorder = new SentryEventRecorder();
        $exception = new \Exception();
        $otherException = new \Exception();
        $recorder->addExceptionEventId($exception, 'abc');

        $this->assertEquals(null, $recorder->getEventIdForException($otherException));
    }

    public function testIgnoresEmptyIds()
    {
        $recorder = new SentryEventRecorder();
        $exception = new \Exception();
        $recorder->addExceptionEventId($exception, '');

        $this->assertEquals(null, $recorder->getEventIdForException($exception));
    }
}
