<?php

namespace FDevs\ContactUsBundle\Sonata\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ContactUsAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('createdAt', 'datetime', ['widget' => 'single_text', 'read_only' => true])
            ->add('ip', null, ['read_only' => true])
            ->add('email', null, ['read_only' => true])
            ->add('name', null, ['read_only' => true])
            ->add('phone', null, ['read_only' => true])
            ->add('message', 'textarea', ['read_only' => true]);

    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('email')
            ->add('name')
            ->add('createdAt')
            ->add('phone');
    }

}
