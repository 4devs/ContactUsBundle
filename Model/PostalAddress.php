<?php

namespace FDevs\ContactUsBundle\Model;

class PostalAddress
{

    /**
     * @var string $postOfficeBoxNumber
     */
    protected $postOfficeBoxNumber;

    /**
     * @var string $postalCode
     */
    protected $postalCode;

    /**
     * @var \FDevs\PageBundle\Model\LocaleText
     */
    protected $country = array();

    /**
     * @var \FDevs\PageBundle\Model\LocaleText
     */
    protected $locality = array();

    /**
     * @var \FDevs\PageBundle\Model\LocaleText
     */
    protected $region = array();

    /**
     * @var \FDevs\PageBundle\Model\LocaleText
     */
    protected $streetAddress = array();

    /**
     * init
     */
    public function __construct()
    {
        $this->country = new \Doctrine\Common\Collections\ArrayCollection();
        $this->locality = new \Doctrine\Common\Collections\ArrayCollection();
        $this->region = new \Doctrine\Common\Collections\ArrayCollection();
        $this->streetAddress = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set postOfficeBoxNumber
     *
     * @param string $postOfficeBoxNumber
     *
     * @return self
     */
    public function setPostOfficeBoxNumber($postOfficeBoxNumber)
    {
        $this->postOfficeBoxNumber = $postOfficeBoxNumber;

        return $this;
    }

    /**
     * Get postOfficeBoxNumber
     *
     * @return string $postOfficeBoxNumber
     */
    public function getPostOfficeBoxNumber()
    {
        return $this->postOfficeBoxNumber;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return self
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string $postalCode
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Add country
     *
     * @param \FDevs\PageBundle\Model\LocaleText $country
     *
     * @return $this
     */
    public function addCountry(\FDevs\PageBundle\Model\LocaleText $country)
    {
        $this->country[] = $country;

        return $this;
    }

    /**
     * Remove country
     *
     * @param \FDevs\PageBundle\Model\LocaleText $country
     *
     * @return $this
     */
    public function removeCountry(\FDevs\PageBundle\Model\LocaleText $country)
    {
        $this->country->removeElement($country);

        return $this;
    }

    /**
     * Get country
     *
     * @return \Doctrine\Common\Collections\Collection $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add locality
     *
     * @param \FDevs\PageBundle\Model\LocaleText $locality
     *
     * @return $this
     */
    public function addLocality(\FDevs\PageBundle\Model\LocaleText $locality)
    {
        $this->locality[] = $locality;

        return $this;
    }

    /**
     * Remove locality
     *
     * @param \FDevs\PageBundle\Model\LocaleText $locality
     *
     * @return $this
     */
    public function removeLocality(\FDevs\PageBundle\Model\LocaleText $locality)
    {
        $this->locality->removeElement($locality);

        return $this;
    }

    /**
     * Get locality
     *
     * @return \Doctrine\Common\Collections\Collection $locality
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Add region
     *
     * @param \FDevs\PageBundle\Model\LocaleText $region
     *
     * @return $this
     */
    public function addRegion(\FDevs\PageBundle\Model\LocaleText $region)
    {
        $this->region[] = $region;

        return $this;
    }

    /**
     * Remove region
     *
     * @param \FDevs\PageBundle\Model\LocaleText $region
     *
     * @return $this
     */
    public function removeRegion(\FDevs\PageBundle\Model\LocaleText $region)
    {
        $this->region->removeElement($region);

        return $this;
    }

    /**
     * Get region
     *
     * @return \Doctrine\Common\Collections\Collection $region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Add streetAddress
     *
     * @param \FDevs\PageBundle\Model\LocaleText $streetAddress
     *
     * @return $this
     */
    public function addStreetAddress(\FDevs\PageBundle\Model\LocaleText $streetAddress)
    {
        $this->streetAddress[] = $streetAddress;

        return $this;
    }

    /**
     * Remove streetAddress
     *
     * @param \FDevs\PageBundle\Model\LocaleText $streetAddress
     *
     * @return $this
     */
    public function removeStreetAddress(\FDevs\PageBundle\Model\LocaleText $streetAddress)
    {
        $this->streetAddress->removeElement($streetAddress);

        return $this;
    }

    /**
     * Get streetAddress
     *
     * @return \Doctrine\Common\Collections\Collection $streetAddress
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @param \FDevs\PageBundle\Model\LocaleText[] $streetAddress
     *
     * @return $this
     */
    public function setStreetAddress($streetAddress)
    {
        foreach ($streetAddress as $address) {
            $this->addStreetAddress($address);
        }

        return $this;
    }
}
