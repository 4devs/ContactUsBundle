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

        $supportedDrivers = ['mongodb', 'orm', 'custom'];
        $supportedAdminService = ['sonata','none'];

        $rootNode
            ->children()
                ->scalarNode('class')->cannotBeEmpty()->defaultValue('FDevs\ContactUsBundle\Model\Message')->end()
                ->scalarNode('form_type')->cannotBeEmpty()->defaultValue('contact_us_message')->end()
                ->scalarNode('form_action')->cannotBeEmpty()->defaultValue('f_devs_contact_us_form')->end()
                ->arrayNode('email')
                    ->children()
                        ->scalarNode('from')->isRequired()->end()
                        ->scalarNode('template_name')->defaultValue('FDevsContactUsBundle:Email:message.html.twig')->end()
                        ->scalarNode('subject')->defaultValue('Contact Us Message')->end()
                        ->arrayNode('emails')
                            ->requiresAtLeastOneElement()
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('database')
                    ->children()
                        ->scalarNode('model_manager')
                            ->cannotBeEmpty()
                            ->defaultValue('f_devs_contact_us.doctrine.message_manager')
                        ->end()
                        ->scalarNode('admin_service')
                            ->defaultValue('none')
                            ->validate()
                            ->ifNotInArray($supportedAdminService)
                            ->thenInvalid('The admin service %s is not supported. Please choose one of '.json_encode($supportedAdminService))
                            ->end()
                        ->end()
                        ->scalarNode('doctrine_manager_name')->defaultNull()->end()
                        ->scalarNode('db_driver')
                            ->cannotBeEmpty()
                            ->defaultValue('custom')
                            ->validate()
                            ->ifNotInArray($supportedDrivers)
                            ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
