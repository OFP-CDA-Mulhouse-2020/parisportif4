<?php


namespace App\DataFixtures\Sport;


use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{

    public const sport_1 ="sport_1";

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $sport = new Sport();
        $sport->setName ('football');
        $sport->setNbTeams (2);
        $sport->setNbPlayers (11);

        $manager->persist ($sport);
        $manager->flush ();

        $this->addReference (self::sport_1,$sport);


    }
}