<?php

namespace FDevs\ContactUsBundle\Model;

interface EmailInterface extends MessageInterface
{
    /**
     * get email
     *
     * @return string
     */
    public function getEmail();
}
