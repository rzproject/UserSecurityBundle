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
        $loader->load('model.xml');

        // Class file namespaces.
        $this->getEntitySection($container, $config);
        $this->getGatewaySection($container, $config);
        $this->getRepositorySection($container, $config);
        $this->getManagerSection($container, $config);
        $this->getModelSection($container, $config);
        $this->getComponentSection($container, $config);

        // Configuration stuff.
        $this->getLoginShieldSection($container, $config);
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getEntitySection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.entity.user.class', $config['entity']['user']['class']);
        $container->setParameter('rz_user_security.entity.session.class', $config['entity']['session']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getGatewaySection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.gateway.session.class', $config['gateway']['session']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getRepositorySection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.repository.session.class', $config['repository']['session']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getManagerSection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.manager.session.class', $config['manager']['session']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getModelSection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.model.session.class', $config['model']['session']['class']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getComponentSection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.component.authentication.handler.login_failure_handler.class', $config['component']['authentication']['handler']['login_failure_handler']['class']);
        $container->setParameter('rz_user_security.component.authentication.tracker.login_failure_tracker.class', $config['component']['authentication']['tracker']['login_failure_tracker']['class']);

        $container->setParameter('rz_user_security.component.authorisation.security_manager.class', $config['component']['authorisation']['security_manager']['class']);
        $container->setParameter('rz_user_security.component.authorisation.voter.client_login_voter.class', $config['component']['authorisation']['voter']['client_login_voter']['class']);

        $container->setParameter('rz_user_security.component.listener.blocking_login_listener.class', $config['component']['listener']['blocking_login_listener']['class']);
        $container->setParameter('rz_user_security.component.listener.defer_login_listener.class', $config['component']['listener']['defer_login_listener']['class']);
        $container->setParameter('rz_user_security.component.access_denied_exception_factory.class', $config['component']['listener']['blocking_login_listener']['access_denied_exception_factory']);

        return $this;
    }

    /**
     *
     * @access private
     * @param  array                                                                  $config
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder                $container
     * @return \CCDNUser\SecurityBundle\DependencyInjection\CCDNUserSecurityExtension
     */
    private function getLoginShieldSection(ContainerBuilder $container, $config)
    {
        $container->setParameter('rz_user_security.login_shield.route_login', $config['login_shield']['route_login']);
        $container->setParameter('rz_user_security.login_shield.force_account_recovery', $config['login_shield']['force_account_recovery']);
        $container->setParameter('rz_user_security.login_shield.block_pages', $config['login_shield']['block_pages']);

        return $this;
    }
}
