<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\DomCrawler\Tests\ImageTest;
use App\Entity\CardImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class AddControllerTest extends TestParent
{
    public function testSomething()
    {
        $this->assertTrue(true);
    }

    public function testAjoutCard()
    {

        $crawler = $this->getClient()->request('GET', '/fr/TestDoctrine/');
        $response = $this->getClient()->getResponse();
     //   dump($crawler);
        $countOfItemsBeforeAdd = count($crawler->filter('.crw-items > tr'));

        $this->assertEquals('200', $response->getStatusCode());
        $crawler = $this->getClient()->request('GET', '/fr/TestDoctrine/add');
        $response = $this->getClient()->getResponse();
        $this->assertEquals('200', $response->getStatusCode());


        $form = $crawler->selectButton('Save')->form();
        $form['card[name]'] = 'Droll & Lock Bird';
        $form['card[atk]'] = 0;
        $form['card[def]'] = 0;
        $form['card[type]'] = 'SpellCaster';
        $form['card[prix]'] = 9;
        $form['card[quantity]'] = 98;
        $form['card[image][file]'] = __DIR__.'/imageTest/Droll.png';
        $this->getClient()->submit($form);
        //redirection su l'accueil pour compter les cartes
        $crawler = $this->getClient()->request('GET', '/fr/TestDoctrine/');
        $countOfItemsAfterAdd = count($crawler->filter('.crw-items > tr'));

        $this->assertTrue($countOfItemsAfterAdd > $countOfItemsBeforeAdd);
        $doctrine= self::$kernel->getContainer()->get('doctrine');
        $card = $doctrine->getRepository('App\Entity\Card')->findOneByName('Droll & Lock Bird');
        $doctrine->getManager()->remove($card);
        $doctrine->getManager()->flush();
        //compté le nb de carte avant et après
    }


}
