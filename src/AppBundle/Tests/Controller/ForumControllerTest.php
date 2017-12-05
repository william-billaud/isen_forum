<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ForumControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/forum/');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/forum/add');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->markTestIncomplete('Test incomplet, output à verifier');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'forum/1');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->markTestIncomplete('Test incomplet, output à verifier');
    }

}
