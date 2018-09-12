<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AfficheDonneeTest extends TestParent
{





    public function testSomething()
    {
        $this->assertTrue(true);
    }


    /**
     * @dataProvider urlProvider
     */
    public function testPageAccueil($url)
    {
        $this->getClient()->request('GET', $url);

       $this->assertEquals(Response::HTTP_OK, $this->getClient()->getResponse()->getStatusCode());
    }

    public function urlProvider(){

        yield['/fr/TestDoctrine/'];
        yield['/fr/TestDoctrine/add'];
        yield['/fr/TestDoctrine/login'];
        yield['/fr/TestDoctrine/inscription'];
    }



}
