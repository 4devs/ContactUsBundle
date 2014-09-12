<?php
namespace FDevs\ContactUsBundle\Twig;

use FDevs\ContactUsBundle\Model\Connect;

class ConnectExtension extends \Twig_Extension
{
    private $tplList = [];
    private $defaultTpl = 'FDevsContactUsBundle:Connect:default.html.twig';

    public function getName()
    {
        return 'fdevs_contact_us_connect';
    }

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

    public function connectFunction(\Twig_Environment $environment, Connect $data)
    {
        $tpl = empty($this->tplList[$data->getType()]) ? $this->defaultTpl : $this->tplList[$data->getType()];

        return $environment->render($tpl, ['data' => $data]);
    }

    /**
     * set Tpl List
     *
     * @param array $tplList
     *
     * @return self
     */
    public function setTplList(array $tplList)
    {
        $this->tplList = $tplList;

        return $this;
    }

}
