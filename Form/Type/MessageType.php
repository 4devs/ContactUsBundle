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
            ->add('email', 'email', ['attr' => ['placeholder' => 'placeholder.email']])
            ->add('name', 'text', ['attr' => ['placeholder' => 'placeholder.name']])
            ->add('phone', 'tel', [
                'attr'            => ['placeholder' => 'placeholder.phone'],
                'required'        => false,
                'invalid_message' => 'f_devs_contact_us.phone.invalid'
            ])
            ->add('message', 'textarea', ['attr' => ['placeholder' => 'placeholder.message']])
            ->add('submit', 'submit', ['label' => 'form.submit']);
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
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'FDevs\ContactUsBundle\Model\Message',
            'translation_domain' => 'FDevsContactUsBundle',
        ]);
    }
}
