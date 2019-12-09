<?php

use Classmarkets\RavenBundle\Controller\TestController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$collection = new RouteCollection();
$collection->add('cm_raven_bundle_test', new Route('/_cm_raven_bundle_test', [
    '_controller' => TestController::class . '::testAction',
]));

return $collection;
