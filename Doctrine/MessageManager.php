<?php

namespace FDevs\ContactUsBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use FDevs\ContactUsBundle\Model\MessageInterface;
use FDevs\ContactUsBundle\Model\ModelManagerInterface;

class MessageManager implements ModelManagerInterface
{
    /** @var ObjectManager */
    private $objectManager = null;

    /**
     * init.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritDoc}
     */
    public function persist(MessageInterface $message)
    {
        $this->objectManager->persist($message);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function flush(MessageInterface $message)
    {
        $this->objectManager->flush();

        return $this;
    }
}
