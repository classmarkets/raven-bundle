<?php

namespace Classmarkets\RavenBundle;

// Since there is no interface for the raven client we have no choice
// but to extend the base class, even though this is really a decorator
class RecordingRavenClient extends \Raven_Client
{
    /** @var \Raven_Client */
    private $client;

    /** @var SentryEventRecorder */
    private $recorder;

    public function __construct(\Raven_Client $client, SentryEventRecorder $recorder)
    {
        $this->client = $client;
        $this->recorder = $recorder;
    }

    public function captureException($exception, $culpritOrOptions = null, $logger = null, $vars = null)
    {
        $eventId = $this->client->captureException($exception, $culpritOrOptions, $logger, $vars);

        if ($eventId) {
            $ident = $this->client->getIdent($eventId);
            $this->recorder->addExceptionEventId($exception, $ident);
        }

        return $eventId;
    }

    // Delegate all other methods to the real client. Since we don't
    // implement an interface, we can't use __call, unfortunately.
    //
    // @codeCoverageIgnoreStart

    public function getLastError()
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function getIdent($ident)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function message($message, $params=array(), $level=self::INFO, $stack=false, $vars = null)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function exception($exception)
    {
        // this one is deprecated, so we don't decorate it
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function captureMessage($message, $params=array(), $level_or_options=array(), $stack=false, $vars = null)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function captureQuery($query, $level=self::INFO, $engine = '')
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function get_default_data()
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function capture($data, $stack, $vars = null)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function sanitize(&$data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function process(&$data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function sendUnsentErrors()
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function send($data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function translateSeverity($severity)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function registerSeverityMap($map)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function set_user_data($id, $email=null, $data=array())
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function user_context($data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function tags_context($data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }
    public function extra_context($data)
    {
        return call_user_func_array(array($this->client, __FUNCTION__), func_get_args());
    }

    // @codeCoverageIgnoreEnd
}
