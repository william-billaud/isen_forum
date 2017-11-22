<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopicControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'forum/1/topic/1');

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'forum/1/topic/add');

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }

}
