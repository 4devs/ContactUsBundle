<?php
namespace FDevs\ContactUsBundle\Twig;

use FDevs\ContactUsBundle\Model\Connect;

class ConnectExtension extends \Twig_Extension
{
    /** @var string */
    private $defaultTpl = 'FDevsContactUsBundle:Contact:connect.html.twig';

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_contact_us_connect';
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'connect',
                [$this, 'connectFunction'],
                ['needs_environment' => true, 'is_safe' => ['html']]
            )
        ];
    }

    /**
     * twig render block
     *
     * @param \Twig_Environment $environment
     * @param Connect           $data
     * @param array             $options
     *
     * @return string
     */
    public function connectFunction(\Twig_Environment $environment, Connect $data, array $options = [])
    {
        $template = empty($options['template']) ? $this->defaultTpl : $options['template'];

        if (!$template instanceof \Twig_Template) {
            $template = $environment->loadTemplate($template);
        }
        $block = $template->hasBlock($data->getType()) ? $data->getType() : 'default';

        return $template->renderBlock($block, array('data' => $data, 'options' => $options));
    }

    /**
     * set Default Tpl
     *
     * @param string $defaultTpl
     *
     * @return $this
     */
    public function setDefaultTpl($defaultTpl)
    {
        $this->defaultTpl = $defaultTpl;

        return $this;
    }

}
