<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Wallet;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setWallet(new Wallet());
        $user->setFirstname("namoune");
        $user->setLastname("Sofiane");
        $user->setEmail("sofiane1@gmail.com");
        $user->setBirthDate(DateTime::createFromFormat('Y-m-d', '1994-01-04'));
        $user->setStreet("Rue vauban");
        $user->setStreetNumber("85");
        $user->setCodePostal("68100");
        $user->setCity("Mulhouse");
        $user->setPhone("0797478532");
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword('$2y$12$2ccpBT1toKcy/1GWcEcNbeeV2Bp6jjnh.T4ia49tfe6HmyPbpUM0W');
        $manager->persist($user);

        $user2 = new User();
        $user2->setWallet(new Wallet());
        $user2->setFirstname("bazine");
        $user2->setLastname("mohammmed");
        $user2->setEmail("sofiane2@gmail.com");
        $user2->setBirthDate(DateTime::createFromFormat('Y-m-d', '1994-01-04'));
        $user2->setStreet("XX xx");
        $user2->setStreetNumber("70");
        $user2->setCodePostal("75000");
        $user2->setCity("paris");
        $user2->setPhone("0697478532");
        $user2->setRoles(["ROLE_USER"]);
        $user2->setPassword('$2y$12$2ccpBT1toKcy/1GWcEcNbeeV2Bp6jjnh.T4ia49tfe6HmyPbpUM0W');
        $manager->persist($user2);

        $manager->flush();
    }
}
