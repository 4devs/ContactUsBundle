<?php

namespace FDevs\ContactUsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostalAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', 'translatable')
            ->add('locality', 'translatable')
            ->add('region', 'translatable')
            ->add('postOfficeBoxNumber')
            ->add('postalCode')
            ->add('streetAddress', 'translatable');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'FDevs\ContactUsBundle\Model\PostalAddress'
            ]
        );
    }

    public function getName()
    {
        return 'fdevs_postal_address';
    }

}
