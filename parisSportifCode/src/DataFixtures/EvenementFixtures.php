<?php


namespace App\DataFixtures;


use App\Entity\EvenementSport;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $evenement1 = new EvenementSport();
        $sport = $this->getReference (SportFixtures::sport_1);
        $equipe1 = $this->getReference (EquipeFixtures::equipe_1);
        $equipe2 = $this->getReference (EquipeFixtures::equipe_2);
        $competition = $this->getReference (CompetitionFixtures::competition_1);
        $evenement1->setName ('match amicale')
                  ->setBeginDate (DateTime::createFromFormat ('Y-m-d H:i:s','2021-01-20 19:00:00'))
                  ->setEventPlace ('Espagne')
                  ->setSport ($sport)
                  ->addEquipe ($equipe1)
                  ->addEquipe ($equipe2)
                  ->setCompetionn ($competition);
        $manager->persist ($evenement1);


        $manager->flush ();


    }

    public function getDependencies (): array
    {
        return [
            CompetitionFixtures::class,
            SportFixtures::class
        ];
    }
}