<?php

namespace Rz\UserSecurityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RzUserSecurityExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('components.xml');
        $this->getComponentSection($container, $config);

    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \Rz\UserSecurityBundle\DependencyInjection\RzUserSecurityExtension
     */
    private function getComponentSection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.component.authentication.handler.login_failure_handler.class', $config['component']['authentication']['handler']['login_failure_handler']['class']);
        $container->setParameter('rz_user_security.component.authentication.handler.login_success_handler.class', $config['component']['authentication']['handler']['login_success_handler']['class']);
        $container->setParameter('rz_user_security.component.authentication.handler.logout_success_handler.class', $config['component']['authentication']['handler']['logout_success_handler']['class']);
        $container->setParameter('rz_user_security.component.authentication.tracker.login_failure_tracker.class', $config['component']['authentication']['tracker']['login_failure_tracker']['class']);

        $container->setParameter('rz_user_security.component.listener.route_referer_listener.class', $config['component']['listener']['route_referer_listener']['class']);

        $container->setParameter('rz_user_security.component.listener.blocking_login_listener.class', $config['component']['listener']['blocking_login_listener']['class']);
        $container->setParameter('rz_user_security.component.listener.blocking_login_listener.translation_domain', $config['component']['listener']['blocking_login_listener']['translation']);
        $container->setParameter('rz_user_security.component.listener.blocking_login_listener.template', $config['component']['listener']['blocking_login_listener']['template']);

        $container->setParameter('rz_user_security.lockout_session.manager.class', $config['lockout_session']['manager']['class']);

        return $this;
    }

}
