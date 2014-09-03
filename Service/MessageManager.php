<?php

namespace FDevs\ContactUsBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use FDevs\ContactUsBundle\Model\Message;
use Symfony\Component\Templating\EngineInterface;

class MessageManager
{
    /** @var array */
    private $emails = [];
    /** @var \Swift_Mailer */
    private $mailer;
    /** @var ObjectManager|null */
    private $objectManager;
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
     * @param ObjectManager $objectManager
     */
    public function __construct(
        array $emails,
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $templateName,
        $fromEmail,
        ObjectManager $objectManager = null
    ) {
        $this->fromEmail = $fromEmail;
        $this->mailer = $mailer;
        $this->emails = $emails;
        $this->objectManager = $objectManager;
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
        if ($this->objectManager) {
            $this->objectManager->persist($message);
            $this->objectManager->flush();
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
