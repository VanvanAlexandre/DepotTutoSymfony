<?php
/**
 * Created by PhpStorm.
 * User: Perso
 * Date: 11/09/2018
 * Time: 12:17
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestParent extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient(array(),array());

    }

    public function getClient(){
        return $this->client;
    }
}