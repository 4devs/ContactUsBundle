<?php

namespace FDevs\ContactUsBundle\EventListener;

use FDevs\ContactUsBundle\Event\MessageEvent;
use FDevs\ContactUsBundle\Model\ModelManagerInterface;

class DoctrineListener
{
    /** @var ModelManagerInterface */
    private $manager;

    /**
     * init.
     *
     * @param ModelManagerInterface $manager
     */
    public function __construct(ModelManagerInterface $manager)
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
        $this->manager->persist($message);
        $this->manager->flush($message);
    }
}
