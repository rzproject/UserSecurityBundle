<?php

namespace Rz\UserSecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Rz\UserSecurityBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

class RzUserSecurityBundle extends Bundle
{

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
