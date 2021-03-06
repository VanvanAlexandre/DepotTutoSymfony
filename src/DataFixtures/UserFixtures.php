<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setNom('McCanada OUI');
        $user->setPrenom('Amber');
        $user->setPassword('patate');
        $user->setAge(19);
        $user->setSalt('');
        $user->setUsername('amber');
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);
        $manager->flush();
    }
}
