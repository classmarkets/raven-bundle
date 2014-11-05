<?php

namespace Classmarkets\RavenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TestController extends Controller
{
    public function testAction()
    {
        $this->get('twig.controller.exception')->disableDebug();

        throw new HttpException(500);
    }
}
