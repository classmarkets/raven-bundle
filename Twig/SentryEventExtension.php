<?php

namespace Classmarkets\RavenBundle\Twig;

use Classmarkets\RavenBundle\SentryEventRecorder;

class SentryEventExtension extends \Twig_Extension
{
    /** @var SentryEventRecorder */
    private $recorder;

    public function __construct(SentryEventRecorder $recorder)
    {
        $this->recorder = $recorder;
    }

    public function getName()
    {
        return 'sentry_event_extension';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('sentry_event_id', [$this->recorder, 'getEventIdForException']),
        ];
    }
}
