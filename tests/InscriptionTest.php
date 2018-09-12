<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class InscriptionTest extends TestParent
{
    public function testSomething()
    {
        $this->assertTrue(true);
    }

    public function testInscription()
    {
//        self::$kernel->getContainer()->get('doctrine')->getManager()->persist($testClient);
        $crawler = $this->getClient()->request('GET', '/fr/TestDoctrine/');
        $response = $this->getClient()->getResponse();
        $this->assertEquals('200', $response->getStatusCode());
        $crawler = $this->getClient()->request('GET', '/fr/TestDoctrine/inscription');
        $response = $this->getClient()->getResponse();
        $this->assertEquals('200', $response->getStatusCode());


        $form = $crawler->selectButton('Inscription')->form();
        $form['user[username]'] = 'test';
        $form['user[nom]'] = 'test';
        $form['user[prenom]'] = 'test';
        $form['user[age]'] = 789897979;
        $form['user[password]'] = 'test';
        $this->getClient()->submit($form);
        $userRepository= self::$kernel->getContainer()->get('doctrine')->getRepository('App\Entity\User');
        $username= $userRepository->findOneByUsername('test');

        $this->assertEquals('test',$username->getUsername());



    }
}
