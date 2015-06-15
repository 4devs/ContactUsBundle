<?php

namespace FDevs\ContactUsBundle\Model;

class Message extends Email implements EmailInterface
{
    /**
     * @var mixed $id
     */
    protected $id;

    /**
     * @var string $phone
     */
    protected $phone;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * init.
     *
     * @param string $ip
     */
    public function __construct($ip = '')
    {
        $this->setClientIp($ip);
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Get id
     *
     * @return mixed $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
