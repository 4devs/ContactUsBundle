<?php

namespace FDevs\ContactUsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FDevsContactUsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias() . '.emails', $config['emails']);
        $container->setParameter($this->getAlias() . '.from', $config['from']);
        $container->setParameter($this->getAlias() . '.template_name', $config['template_name']);
        $container->setParameter($this->getAlias() . '.manager_name', $config['manager_name']);
        $container->setParameter($this->getAlias() . '.tpl.contact', $config['tpl']['contact']);
        $container->setParameter($this->getAlias() . '.tpl.list', $config['tpl']['list']);
        $container->setParameter($this->getAlias() . '.tpl.connect', $config['tpl']['connect']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        if ('custom' !== $config['db_driver']) {
            $loader->load(sprintf('%s.xml', $config['db_driver']));
            $container->setParameter($this->getAlias() . '.backend_type_' . $config['db_driver'], true);
        }

        if ($config['admin_service']) {
            $loader->load('admin/' . $config['admin_service'] . '.xml');
        }
    }
}
