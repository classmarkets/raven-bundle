<?php

namespace Classmarkets\RavenBundle;

class SentryEventRecorder
{
    /** @var string[] */
    private $idStore;

    public function __construct()
    {
        $this->idStore = array();
    }

    public function addExceptionEventId($exception, $id)
    {
        if (is_object($exception) && !empty($id)) {
            $this->idStore[spl_object_hash($exception)] = $id;
        }
    }

    public function getEventIdForException($exception)
    {
        if (!is_object($exception)) {
            return null;
        }

        $hash = spl_object_hash($exception);

        if (isset($this->idStore[$hash])) {
            return $this->idStore[$hash];
        }

        return null;
    }

    public function addExceptionAlias($originalException, $aliasException)
    {
        if ($eventId = $this->getEventIdForException($originalException)) {
            $this->addExceptionEventId($aliasException, $eventId);
        }
    }
}
