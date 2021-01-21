<?php


namespace App\DataFixtures;


use App\DataFixtures\Sport\Barcelonne\EquipeBFixtures;
use App\DataFixtures\Sport\Liverpool\EquipeLFixtures;
use App\DataFixtures\Sport\SportFixtures;
use App\Entity\EvenementSport;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{

    public const evenement_1 ="evenement_1";

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $evenement1 = new EvenementSport();
        $sport = $this->getReference (SportFixtures::sport_1);
        $equipe1 = $this->getReference (EquipeBFixtures::equipe_1);
        $equipe2 = $this->getReference (EquipeLFixtures::equipe_2);
        $competition = $this->getReference (CompetitionFixtures::competition_1);
        $evenement1->setName ('match amicale')
                  ->setBeginDate (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-20 19:00:00'))
                  ->setEventPlace ('Espagne')
                  ->setSport ($sport)
                  ->addEquipe ($equipe1)
                  ->addEquipe ($equipe2)
                  ->setCompetionn ($competition);
        $manager->persist ($evenement1);

         $this->addReference (self::evenement_1,$evenement1);
        $manager->flush ();


    }

    public function getDependencies (): array
    {
        return [
            CompetitionFixtures::class,
            SportFixtures::class,
            EquipeLFixtures::class,
            EquipeBFixtures::class
        ];
    }
}