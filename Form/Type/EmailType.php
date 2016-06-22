<?php

namespace FDevs\ContactUsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', ['attr' => ['placeholder' => 'placeholder.email']]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'contact_us_email';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'FDevs\ContactUsBundle\Model\Email',
            'translation_domain' => 'FDevsContactUsBundle',
        ]);
    }
}
