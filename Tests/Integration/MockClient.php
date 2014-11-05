<?php

namespace Classmarkets\RavenBundle\Tests\Integration;

// Until there is an interface for the raven client we have no choice
// but to extend the base class, even though this is really a decorator
// (monolog depends on \Raven_Client)
class MockClient extends \Raven_Client
{
    public function getIdent($ident) { return 'abc'; }

    public function capture($data, $stack, $vars = null) { return $this->getIdent(''); }
    public function sendUnsentErrors() { }
    public function send($data) { }
}
