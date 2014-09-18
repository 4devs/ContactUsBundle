<?php

namespace FDevs\ContactUsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('f_devs_contact_us');

        $supportedDrivers = ['mongodb','custom'];
        $supportedAdminService = ['sonata'];
        $rootNode
            ->children()
                ->scalarNode('from')->isRequired()->end()
                ->scalarNode('manager_name')->defaultNull()->end()
                ->scalarNode('admin_service')
                    ->defaultNull()
                    ->validate()
                    ->ifNotInArray($supportedAdminService)
                    ->thenInvalid('The admin service %s is not supported. Please choose one of '.json_encode($supportedAdminService))
                    ->end()
                ->end()
                ->scalarNode('template_name')->defaultValue('FDevsContactUsBundle:Email:message.html.twig')->end()
                ->scalarNode('db_driver')
                    ->defaultValue('custom')
                    ->validate()
                    ->ifNotInArray($supportedDrivers)
                    ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                ->end()
                ->arrayNode('tpl')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('contact')->defaultValue('FDevsContactUsBundle:Contact:contact.html.twig')->end()
                        ->scalarNode('list')->defaultValue('FDevsContactUsBundle:Contact:list.html.twig')->end()
                        ->scalarNode('connect')->defaultValue('FDevsContactUsBundle:Contact:connect.html.twig')->end()
                    ->end()
                ->end()
                ->arrayNode('emails')
                    ->prototype('scalar')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
