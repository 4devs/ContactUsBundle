<?php

namespace FDevs\ContactUsBundle\Service;

use FDevs\ContactUsBundle\Event\MessageEvent;
use FDevs\ContactUsBundle\Event\MessageEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use FDevs\ContactUsBundle\Model\MessageInterface;

class MessageManager
{
    /** @var string */
    private $class;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /**
     * init.
     *
     * @param string                   $class
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct($class, EventDispatcherInterface $dispatcher)
    {
        $this->class = $class;
        $this->dispatcher = $dispatcher;
    }

    /**
     * create
     *
     * @return MessageInterface
     */
    public function create()
    {
        $message = new $this->class();
        $this->dispatcher->dispatch(MessageEvents::CREATE, new MessageEvent($message));

        return $message;
    }

    /**
     * save.
     *
     * @param MessageInterface $message
     *
     * @return array error
     */
    public function save(MessageInterface $message)
    {
        return $this->dispatcher->dispatch(MessageEvents::SAVE, new MessageEvent($message))->getError();
    }
}
