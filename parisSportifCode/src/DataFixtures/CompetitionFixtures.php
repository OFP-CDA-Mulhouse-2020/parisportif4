<?php


namespace App\DataFixtures;


use App\Entity\Competition;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompetitionFixtures extends Fixture
{
    public const competition_1 ='competition_1';
    public const competition_2 ='competition_2';

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $competition = new Competition();

        $competition->setName ('champions ligue')
            ->setStartAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-29 19:00:00'))
            ->setEndAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-29 21:00:00'));
        $manager->persist ($competition);

        $competition1 = new Competition();

        $competition1->setName ('championnat handball')
            ->setStartAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-29 19:00:00'))
            ->setEndAt (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-29 21:00:00'));
        $manager->persist ($competition1);

        $this->addReference (self::competition_1,$competition);
        $this->addReference(self::competition_2,$competition1);
        $manager->flush ();
    }
}