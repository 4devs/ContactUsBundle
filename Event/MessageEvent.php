<?php

namespace FDevs\ContactUsBundle\Event;

use FDevs\ContactUsBundle\Model\MessageInterface;
use Symfony\Component\EventDispatcher\Event;

class MessageEvent extends Event
{
    /** @var MessageInterface */
    private $message;

    /** @var array */
    private $error;

    /**
     * init.
     *
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    /**
     * get message.
     *
     * @return MessageInterface
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * set error message.
     *
     * @param string $error
     */
    public function addError($error)
    {
        $this->error[] = $error;
    }

    /**
     * get error message.
     *
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }
}
