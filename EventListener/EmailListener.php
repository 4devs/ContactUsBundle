<?php

namespace FDevs\ContactUsBundle\EventListener;

use FDevs\ContactUsBundle\Event\MessageEvent;
use FDevs\ContactUsBundle\Service\EmailManager;

class EmailListener
{
    /** @var EmailManager */
    private $manager;

    /**
     * init.
     *
     * @param EmailManager $manager
     */
    public function __construct(EmailManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * on message save.
     *
     * @param MessageEvent $event
     */
    public function onMessageSave(MessageEvent $event)
    {
        $message = $event->getMessage();
        $this->manager->sendEmails($message);
    }
}
