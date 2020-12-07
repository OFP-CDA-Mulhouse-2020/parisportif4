<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail ("sofiane@gmail.com");
        $user->setRoles ([]);
        $user->setPassword ('$2y$10$cOPiyohXvHVaSE9BXByybuoI5Sj39zfj5Isg2AUZJRicnrVoaL62u');
        $manager->persist($user);

        $manager->flush();
    }
}
