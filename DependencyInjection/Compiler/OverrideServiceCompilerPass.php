<?php

namespace Rz\UserSecurityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
//        $definition = $container->getDefinition('ccdn_user_security.component.listener.blocking_login_listener');
//        $definition->setClass($container->getParameter('rz_user_security.component.listener.blocking_login_listener.class'));
//
        $definition = $container->getDefinition('ccdn_user_security.component.listener.route_referer_listener');
        $definition->setClass($container->getParameter('rz_user_security.component.listener.route_referer_listener.class'));

        $definition = $container->getDefinition('ccdn_user_security.component.authentication.handler.login_failure_handler');
        $definition->setClass($container->getParameter('rz_user_security.component.authentication.handler.login_failure_handler.class'));

    }
}
