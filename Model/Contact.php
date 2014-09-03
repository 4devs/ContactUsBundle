<?php

namespace FDevs\ContactUsBundle\Model;

class Contact
{

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $contactName
     */
    protected $contactName;

    /**
     * @var FDevs\ContactUsBundle\Model\PostalAddress
     */
    protected $address;

    /**
     * @var FDevs\GeoBundle\Model\Point
     */
    protected $location;

    /**
     * @var FDevs\PageBundle\Model\LocaleText
     */
    protected $name = array();

    /**
     * @var FDevs\ContactUsBundle\Model\Connect
     */
    protected $connectList = array();

    public function __construct()
    {
        $this->name = new \Doctrine\Common\Collections\ArrayCollection();
        $this->connectList = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     * @return self
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
        return $this;
    }

    /**
     * Get contactName
     *
     * @return string $contactName
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set address
     *
     * @param FDevs\ContactUsBundle\Model\PostalAddress $address
     * @return self
     */
    public function setAddress(\FDevs\ContactUsBundle\Model\PostalAddress $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return FDevs\ContactUsBundle\Model\PostalAddress $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set location
     *
     * @param FDevs\GeoBundle\Model\Point $location
     * @return self
     */
    public function setLocation(\FDevs\GeoBundle\Model\Point $location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return FDevs\GeoBundle\Model\Point $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add name
     *
     * @param FDevs\PageBundle\Model\LocaleText $name
     */
    public function addName(\FDevs\PageBundle\Model\LocaleText $name)
    {
        $this->name[] = $name;
    }

    /**
     * Remove name
     *
     * @param FDevs\PageBundle\Model\LocaleText $name
     */
    public function removeName(\FDevs\PageBundle\Model\LocaleText $name)
    {
        $this->name->removeElement($name);
    }

    /**
     * Get name
     *
     * @return Doctrine\Common\Collections\Collection $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add connectList
     *
     * @param FDevs\ContactUsBundle\Model\Connect $connectList
     */
    public function addConnectList(\FDevs\ContactUsBundle\Model\Connect $connectList)
    {
        $this->connectList[] = $connectList;
    }

    /**
     * Remove connectList
     *
     * @param FDevs\ContactUsBundle\Model\Connect $connectList
     */
    public function removeConnectList(\FDevs\ContactUsBundle\Model\Connect $connectList)
    {
        $this->connectList->removeElement($connectList);
    }

    /**
     * Get connectList
     *
     * @return Doctrine\Common\Collections\Collection $connectList
     */
    public function getConnectList()
    {
        return $this->connectList;
    }
}
