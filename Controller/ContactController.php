<?php

namespace FDevs\ContactUsBundle\Controller;

use FDevs\ContactUsBundle\Service\ContactManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ContactController
{
    /** @var string */
    private $contactTpl;
    /** @var string */
    private $listTpl;
    /** @var ContactManager */
    private $contactManager;
    /** @var EngineInterface */
    private $templating;

    /**
     * init
     *
     * @param EngineInterface $templating
     * @param ContactManager  $contactManager
     * @param string          $listTpl
     * @param string          $contactTpl
     */
    public function __construct(EngineInterface $templating, ContactManager $contactManager, $listTpl, $contactTpl)
    {
        $this->templating = $templating;
        $this->contactManager = $contactManager;
        $this->listTpl = $listTpl;
        $this->contactTpl = $contactTpl;
    }

    public function contactAction(Request $request, $name, $tpl = null)
    {
        $contact = $this->getManager()->getByContactName($name);
        if (!$contact) {
            throw new NotFoundHttpException(sprintf('contact with name "%s" not found', $name));
        }

        $tpl = $tpl ?: $this->contactTpl;

        return $this->render($tpl, ['contact' => $contact]);
    }

    public function listAction(Request $request, $tplList = null, $tplContact = null)
    {
        $tpl = $tplList ?: $this->listTpl;
        $tplContact = $tplContact ?: $this->contactTpl;

        return $this->render($tpl, ['list' => $this->getManager()->getContactList(), 'tpl_contact' => $tplContact]);
    }

    /**
     * get Manager
     *
     * @return \FDevs\ContactUsBundle\Service\ContactManager
     */
    protected function getManager()
    {
        return $this->contactManager;
    }

    protected function render($name, array $parameters = array())
    {
        return $this->templating->renderResponse($name, $parameters);
    }

}
