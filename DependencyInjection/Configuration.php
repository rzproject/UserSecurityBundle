<?php

namespace Rz\UserSecurityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rz_user_security');
        // Class file namespaces.
        $this->addEntitySection($rootNode);
        $this->addGatewaySection($rootNode);
        $this->addRepositorySection($rootNode);
        $this->addManagerSection($rootNode);
        $this->addModelSection($rootNode);
        $this->addComponentSection($rootNode);

        // Configuration stuff.
        $this->addLoginShieldSection($rootNode);
        $this->addRouteRefererSection($rootNode);
        return $treeBuilder;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addEntitySection(ArrayNodeDefinition $node)
    {
        $node
            ->isRequired()
            ->cannotBeEmpty()
            ->children()
                ->arrayNode('entity')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->children()
                        ->arrayNode('user')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->children()
                                ->scalarNode('class')
                                    ->isRequired()
                                    ->cannotBeEmpty()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('session')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('AppBundle\Entity\UserSecurity\Session')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addGatewaySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('gateway')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('session')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Model\Component\Gateway\SessionGateway')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addRepositorySection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('repository')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('session')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Model\Component\Repository\SessionRepository')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('manager')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('session')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Model\Component\Manager\SessionManager')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addModelSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('model')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('session')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Model\FrontModel\SessionModel')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

     /**
      *
      * @access private
      * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
      * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
      */
     private function addRouteRefererSection(ArrayNodeDefinition $node)
     {
         $node
             ->children()
                 ->arrayNode('route_referer')
                    ->canBeUnset()
                     ->ignoreExtraKeys()
                    // we just skip that array!
                 ->end()
             ->end()
         ;

         return $this;
     }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addComponentSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('component')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('authentication')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('handler')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->arrayNode('login_failure_handler')
                                            ->addDefaultsIfNotSet()
                                            ->canBeUnset()
                                            ->children()
                                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authentication\Handler\LoginFailureHandler')->end()
                                            ->end()
                                        ->end()
                                        ->arrayNode('login_success_handler')
                                            ->addDefaultsIfNotSet()
                                            ->canBeUnset()
                                            ->children()
                                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authentication\Handler\LoginSuccessHandler')->end()
                                            ->end()
                                        ->end()
                                        ->arrayNode('logout_success_handler')
                                            ->addDefaultsIfNotSet()
                                            ->canBeUnset()
                                            ->children()
                                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authentication\Handler\LogoutSuccessHandler')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                                ->arrayNode('tracker')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->arrayNode('login_failure_tracker')
                                            ->addDefaultsIfNotSet()
                                            ->canBeUnset()
                                            ->children()
                                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authentication\Tracker\LoginFailureTracker')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('authorisation')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('security_manager')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authorisation\SecurityManager')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('voter')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->arrayNode('client_login_voter')
                                            ->addDefaultsIfNotSet()
                                            ->canBeUnset()
                                            ->children()
                                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Authorisation\Voter\ClientLoginVoter')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('listener')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('route_referer_listener')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Listener\RouteRefererListener')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('defer_login_listener')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Listener\DeferLoginListener')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('blocking_login_listener')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Listener\BlockingLoginListener')->end()
                                        ->scalarNode('access_denied_exception_factory')->defaultValue('Rz\UserSecurityBundle\Component\Listener\AccessDeniedExceptionFactory')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('route_referer_ignore')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('chain')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Listener\Chain\RouteRefererIgnoreChain')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }

    /**
     *
     * @access private
     * @param  \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     * @return \Rz\UserSecurityBundle\DependencyInjection\Configuration
     */
    private function addLoginShieldSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->canBeUnset()
            ->children()
                ->arrayNode('login_shield')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('route_login')
                            ->children()
                                ->scalarNode('name')->end()
                                ->scalarNode('path')->end()
                                ->arrayNode('params')
                                    ->prototype('scalar')
                                    ->end()
                                ->end()
                            ->end()
                        ->end()

                        ->arrayNode('force_account_recovery')
                            ->children()
                                ->booleanNode('enabled')->defaultFalse()->end()
                                ->scalarNode('after_attempts')->defaultValue(15)->end()
                                ->scalarNode('duration_in_minutes')->defaultValue(10)->end()
                                ->arrayNode('route_recover_account')
                                    ->children()
                                        ->scalarNode('name')->end()
                                        ->arrayNode('params')
                                            ->prototype('scalar')
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                                ->arrayNode('routes')
                                    ->prototype('scalar')
                                    ->end()
                                ->end()
                            ->end()
                        ->end()

                        ->arrayNode('block_pages')
                            ->children()
                                ->booleanNode('enabled')->defaultFalse()->end()
                                ->scalarNode('after_attempts')->defaultValue(15)->end()
                                ->scalarNode('duration_in_minutes')->defaultValue(10)->end()
                                ->arrayNode('routes')
                                    ->prototype('scalar')
                                    ->end()
                                ->end()
                            ->end()
                        ->end()

                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }
}
