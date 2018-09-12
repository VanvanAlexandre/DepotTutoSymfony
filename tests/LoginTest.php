<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    private $client;
    private $unLoggedClient;


    public function setUp()
    {
        $this->client = static::createClient(
            array(), array(
                'PHP_AUTH_USER' => 'test@test.com',
                'PHP_AUTH_PW' => 'test',
            )
        );

        $this->unLoggedClient = static::createClient(
            array(), array()
        );
    }
    public function testSomething()
    {
        $this->assertTrue(true);
    }

    public function testLogin()
    {

        $crawler = $this->client->request('GET', '/fr/TestDoctrine/');
        $response = $this->client->getResponse();
        $this->assertEquals('200', $response->getStatusCode());
        $this->unLoggedClient->request('GET', '/fr/TestDoctrine/');
        $this->assertSame(200, $this->unLoggedClient->getResponse()->getStatusCode());
    }
}
