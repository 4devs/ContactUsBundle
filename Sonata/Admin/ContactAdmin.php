<?php

namespace FDevs\ContactUsBundle\Sonata\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ContactAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected $formOptions = ['cascade_validation' => true];

    /**
     * {@inheritDoc}
     */
    protected $baseRoutePattern = 'contact';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('contact', 'fdevs_contact', ['inherit_data' => true, 'label' => false])
            ->add(
                'connectList',
                'collection',
                [
                    'type' => 'fdevs_connect',
                    'allow_delete' => true,
                    'allow_add' => true,
                    'required' => false,
                    'options' => ['label' => false]
                ]
            );

        $formMapper->get('contact')->remove('connectList');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('contactName', null, ['editable' => true])
            ->add('showInContactList', null, ['editable' => true])
            ->add('_action', 'actions', ['actions' => ['edit' => [], 'delete' => []]])
        ;
    }

}
