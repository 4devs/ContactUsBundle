<?php

namespace FDevs\ContactUsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $this->markTestSkipped('Add Test');
    }

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Client $client
     *
     * @return string
     */
    private function getPath($client)
    {
        return $client->getContainer()->get('router')->generate('f_devs_contact_us_form');
    }
}
