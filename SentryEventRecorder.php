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

    /**
     * @param object $exception
     * @param string $id
     */
    public function addExceptionEventId($exception, $id)
    {
        if (is_object($exception) && !empty($id)) {
            $this->idStore[spl_object_hash($exception)] = $id;
        }
    }

    /** @return string|null */
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

    /**
     * Store the same event id for $aliasException as for $originalException
     *
     * @param object $originalException
     * @param object $aliasException
     */
    public function addExceptionAlias($originalException, $aliasException)
    {
        if ($eventId = $this->getEventIdForException($originalException)) {
            $this->addExceptionEventId($aliasException, $eventId);
        }
    }
}
