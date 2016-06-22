<?php

namespace FDevs\ContactUsBundle\Model;

interface ModelManagerInterface
{
    /**
     * persist message.
     *
     * @param MessageInterface $message
     *
     * @return $this
     */
    public function persist(MessageInterface $message);

    /**
     * flush object message.
     *
     * @param MessageInterface $message
     *
     * @return $this
     */
    public function flush(MessageInterface $message);
}
