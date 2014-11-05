<?php

namespace Classmarkets\RavenBundle;

class SentryEventRecorder
{
    /** @var \SplObjectStorage */
    private $idStore;

    public function __construct()
    {
        $this->idStore = new \SplObjectStorage();
    }

    public function addExceptionEventId($exception, $id)
    {
        if (is_object($exception)) {
            $this->idStore->attach($exception, $id);
        }
    }

    public function getEventIdForException($exception)
    {
        if (is_object($exception) && $this->idStore->contains($exception)) {
            return $this->idStore[$exception];
        }

        return null;
    }
}
