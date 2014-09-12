<?php

namespace FDevs\ContactUsBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;

class ContactManager
{
    /** @var \Doctrine\Common\Persistence\ObjectManager */
    private $repo;

    /** @var string */
    private $className;

    /**
     * init
     *
     * @param string        $className
     * @param ObjectManager $manager
     */
    public function __construct($className, ObjectManager $manager)
    {
        $this->className = $className;
        $this->repo = $manager->getRepository($className);
    }

    /**
     * get Contact By Name
     *
     * @param string $name
     *
     * @return Contact|null
     */
    public function getByContactName($name)
    {
        return $this->repo->findOneBy(['contactName' => $name]);
    }

    /**
     * get Contact List
     *
     * @return Contact[]
     */
    public function getContactList()
    {
        return $this->repo->findAll();
    }

}
