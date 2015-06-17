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

        $container->setParameter($this->getAlias().'.class', $config['class']);
        $container->setParameter($this->getAlias().'.form_type', $config['form_type']);
        $container->setParameter($this->getAlias().'.form_action', $config['form_action']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['email'])) {
            $container->setParameter($this->getAlias().'.email.emails', $config['email']['emails']);
            $container->setParameter($this->getAlias().'.email.from', $config['email']['from']);
            $container->setParameter($this->getAlias().'.email.template_name', $config['email']['template_name']);
            $container->setParameter($this->getAlias().'.email.subject', $config['email']['subject']);
            $loader->load('email.xml');
        }

        if (isset($config['database'])) {
            $driver = $config['database']['db_driver'];
            $container->setParameter($this->getAlias().'.doctrine.manager_name', $config['database']['doctrine_manager_name']);
            $container->setParameter($this->getAlias().'.backend_type_'.$driver, true);
            if ('custom' !== $driver) {
                $loader->load(sprintf('%s.xml', $driver));
            }
            $container->setAlias('f_devs_contact_us.model_manager', $config['database']['model_manager']);
            $loader->load('database.xml');

            if ($config['database']['admin_service'] !== 'none') {
                $loader->load(sprintf('admin/%s.xml', $config['database']['admin_service']));
                $loader->load(sprintf('admin/%s_%s.xml', $config['database']['admin_service'], $driver));
            }
        }
    }
}
