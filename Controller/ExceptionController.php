<?php

namespace Classmarkets\RavenBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;

class ExceptionController extends BaseController
{
    public function disableDebug()
    {
        $this->debug = false;
    }
}
