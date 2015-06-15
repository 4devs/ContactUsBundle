<?php

namespace FDevs\ContactUsBundle\Model;

trait MessageTrait
{
    /** @var string */
    protected $clientIp;

    /** @var \DateTime */
    protected $createdAt;

    /**
     * set client ip
     *
     * @param string $ip
     *
     * @return $this
     */
    public function setClientIp($ip)
    {
        $this->clientIp = $ip;

        return $this;
    }

    /**
     * get client ip
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * get created at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * set created at
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
