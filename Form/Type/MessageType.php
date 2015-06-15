<?php

namespace FDevs\ContactUsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['attr' => ['placeholder' => 'placeholder.name']])
            ->add('phone', 'text', ['attr' => ['placeholder' => 'placeholder.phone'], 'required' => false])
            ->add('message', 'textarea', ['attr' => ['placeholder' => 'placeholder.message']]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'contact_us_message';
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'contact_us_email';
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'FDevs\ContactUsBundle\Model\Message',
            'translation_domain' => 'FDevsContactUsBundle',
        ]);
    }
}
