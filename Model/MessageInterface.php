<?php

namespace FDevs\ContactUsBundle\Model;

interface MessageInterface
{
    /**
     * set client ip.
     *
     * @param string $ip
     *
     * @return self
     */
    public function setClientIp($ip);
}
