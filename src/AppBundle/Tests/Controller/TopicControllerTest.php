<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopicControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $this->markTestIncomplete('Test incomplet, output à verifier');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'forum/1/topic/add');

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->markTestIncomplete('Test incomplet, output à verifier');
    }

}
