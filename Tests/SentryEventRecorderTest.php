<?php

namespace Classmarkets\RavenBundle\Tests;

use Exception;

use Classmarkets\RavenBundle\SentryEventRecorder;

class SentryEventRecorderTest extends \PHPUnit_Framework_TestCase
{
    public function testStoreAndRetrieveEventId()
    {
        $recorder = new SentryEventRecorder();
        $exception = new Exception();
        $recorder->addExceptionEventId($exception, 'abc');

        $this->assertEquals('abc', $recorder->getEventIdForException($exception));
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
        $exception = new Exception();
        $otherException = new Exception();
        $recorder->addExceptionEventId($exception, 'abc');

        $this->assertEquals(null, $recorder->getEventIdForException($otherException));
    }

    public function testIgnoresEmptyIds()
    {
        $recorder = new SentryEventRecorder();
        $exception = new Exception();
        $recorder->addExceptionEventId($exception, '');

        $this->assertEquals(null, $recorder->getEventIdForException($exception));
    }
}
