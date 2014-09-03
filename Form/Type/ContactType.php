<?php

namespace FDevs\ContactUsBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactName')
            ->add('name', 'translatable', ['required' => false])
            ->add('address', 'fdevs_postal_address', ['required' => false])
            ->add('location', 'fdevs_geo_point', ['required' => false])
            ->add('connectList', 'collection', ['type' => 'fdevs_connect', 'allow_delete' => true, 'allow_add' => true]);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'FDevs\ContactUsBundle\Model\Contact'
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_contact';
    }

} 