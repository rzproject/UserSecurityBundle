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
        // override CCDN User Security Component Classes
        $this->addComponentSection($rootNode);
        return $treeBuilder;
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
                                ->arrayNode('blocking_login_listener')
                                    ->addDefaultsIfNotSet()
                                    ->canBeUnset()
                                    ->children()
                                        ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\Listener\BlockingLoginListener')->end()
                                        ->scalarNode('translation')->cannotBeEmpty()->defaultValue('RzUserSecurityBundle')->end()
                                        ->scalarNode('template')->defaultValue('RzUserSecurityBundle:Lockout:layout.html.twig')->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('lockout_session')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('manager')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->scalarNode('class')->defaultValue('Rz\UserSecurityBundle\Component\LockoutManager')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $this;
    }
}
