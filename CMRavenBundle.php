<?php

namespace Classmarkets\RavenBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Classmarkets\RavenBundle\DependencyInjection\Compiler\AddRecorderCompilerPass;

class CMRavenBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddRecorderCompilerPass());
    }


}
