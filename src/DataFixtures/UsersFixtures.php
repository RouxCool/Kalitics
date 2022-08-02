<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 10; $i++) {
            $user = new Users();
            $user->setNom("Déchant N°$i")
                ->setPrenom("Didier N°$i")
                ->setMatricule(rand(1000, 9999));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
