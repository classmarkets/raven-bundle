<?php

namespace Classmarkets\RavenBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionController extends BaseController
{
    public function disableDebug()
    {
        $this->debug = false;
    }
}
