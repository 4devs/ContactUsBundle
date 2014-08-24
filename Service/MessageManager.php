<?php

namespace FDevs\ContactUsBundle\Service;

use Doctrine\Common\Persistence\ManagerRegistry;
use FDevs\ContactUsBundle\Model\Message;
use Symfony\Component\Templating\EngineInterface;

class MessageManager
{
    /** @var array */
    private $emails = [];
    /** @var \Swift_Mailer */
    private $mailer;
    /** @var \Doctrine\Common\Persistence\ManagerRegistry|null */
    private $managerRegistry;
    /** @var \Symfony\Component\Templating\EngineInterface */
    private $templating;
    /** @var string A template name or a TemplateReferenceInterface instance */
    private $templateName;
    /** @var string */
    private $fromEmail;

    /**
     * init
     *
     * @param array           $emails
     * @param \Swift_Mailer   $mailer
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(
        array $emails,
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $templateName,
        $fromEmail,
        ManagerRegistry $managerRegistry = null
    ) {
        $this->fromEmail = $fromEmail;
        $this->mailer = $mailer;
        $this->emails = $emails;
        $this->managerRegistry = $managerRegistry;
        $this->templating = $templating;
        $this->templateName = $templateName;
    }

    public function create(Message $message)
    {
        $this->persistDB($message)
            ->sendEmails($message);

        return true;
    }

    private function persistDB(Message $message)
    {
        if ($this->managerRegistry) {
            $this->managerRegistry->getManager()->persist($message);
            $this->managerRegistry->getManager()->flush();
        }

        return $this;
    }

    private function sendEmails(Message $message)
    {
        $email = \Swift_Message::newInstance()
            ->setSubject('Contact Us Message')
            ->setFrom($this->fromEmail)
            ->setReplyTo($message->getEmail())
            ->setTo($this->emails)
            ->setBody($this->templating->render($this->templateName, ['message' => $message]), 'text/html');

        $this->mailer->send($email);

        return $this;
    }

}
