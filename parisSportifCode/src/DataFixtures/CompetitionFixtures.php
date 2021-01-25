<?php


namespace App\DataFixtures;


use App\Entity\Competition;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture
{
    public const competition_1 ='competition_1';

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $competition = new Competition();

        $competition->setName ('journee amicale')
            ->setStartAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-20 19:00:00'))
            ->setEndAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-20 21:00:00'));
        $manager->persist ($competition);

        $this->addReference (self::competition_1,$competition);
        $manager->flush ();
    }
}