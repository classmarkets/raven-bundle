<?php

namespace Classmarkets\RavenBundle\Controller;

use Symfony\Component\HttpKernel\Exception\HttpException;

class TestController
{
    private $exceptionController;

    public function __construct(ExceptionController $exceptionController)
    {
        $this->exceptionController = $exceptionController;
    }

    public function testAction()
    {
        $this->exceptionController->disableDebug();

        throw new HttpException(500);
    }
}
