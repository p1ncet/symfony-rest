<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testGetAllMessagesPost(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/messages/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
