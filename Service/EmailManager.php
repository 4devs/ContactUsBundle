<?php

namespace FDevs\ContactUsBundle\Service;

use FDevs\ContactUsBundle\Model\EmailInterface;
use Symfony\Component\Templating\EngineInterface;

class EmailManager
{
    /** @var array */
    private $emails;

    /** @var \Swift_Mailer */
    private $mailer;

    /** @var EngineInterface */
    private $templating;

    /** @var string A template name or a TemplateReferenceInterface instance */
    private $templateName;

    /** @var string */
    private $fromEmail;

    /** @var string */
    private $subject;

    /**
     * init.
     *
     * @param array           $emails
     * @param \Swift_Mailer   $mailer
     * @param EngineInterface $templating
     * @param string          $templateName
     * @param string          $fromEmail
     * @param string          $subject
     */
    public function __construct(
        array $emails,
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $templateName,
        $fromEmail,
        $subject
    ) {
        $this->emails = $emails;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->templateName = $templateName;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
    }

    /**
     * send message.
     *
     * @param EmailInterface $message
     * @param string         $subject
     *
     * @return $this
     */
    public function sendEmails(EmailInterface $message, $subject = '')
    {
        $email = \Swift_Message::newInstance()
            ->setSubject($subject ?: $this->subject)
            ->setFrom($this->fromEmail)
            ->setReplyTo($message->getEmail())
            ->setTo($this->emails)
            ->setBody($this->templating->render($this->templateName, ['message' => $message]), 'text/html');

        $this->mailer->send($email);

        return $this;
    }
}
