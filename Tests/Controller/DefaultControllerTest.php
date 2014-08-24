<?php

namespace FDevs\ContactUsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $this->getPath($client));

        $this->assertFalse($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
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
