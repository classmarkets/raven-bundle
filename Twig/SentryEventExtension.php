<?php

namespace Classmarkets\RavenBundle\Twig;

use Classmarkets\RavenBundle\SentryEventRecorder;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SentryEventExtension extends AbstractExtension
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
            new TwigFunction('sentry_event_id', [$this->recorder, 'getEventIdForException']),
        ];
    }
}
