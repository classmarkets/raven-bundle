<?php

namespace Classmarkets\RavenBundle;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener as BaseListener;

class ExceptionListener extends BaseListener
{
    /** @var SentryEventRecorder */
    private $recorder;

    public function setRecorder(SentryEventRecorder $recorder)
    {
        $this->recorder = $recorder;
    }

    protected function duplicateRequest(\Exception $exception, Request $request)
    {
        $request = parent::duplicateRequest($exception, $request);

        if ($request->attributes->has('exception')) {
            $flattenException = $request->attributes->get('exception');

            if ($eventId = $this->recorder->getEventIdForException($exception)) {
                $this->recorder->addExceptionEventId($flattenException, $eventId);
            }
        }

        return $request;
    }
}
