<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('cm_raven_bundle_test', new Route('/_cm_raven_bundle_test', array(
    '_controller' => 'CMRavenBundle:Test:test'
)));

return $collection;
