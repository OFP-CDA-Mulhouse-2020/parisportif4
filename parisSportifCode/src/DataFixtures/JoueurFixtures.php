<?php


namespace App\DataFixtures;


use App\Entity\Joueurs;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JoueurFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $sport = $this->getReference (SportFixtures::sport_1);
        $equipe1 = $this->getReference (EquipeFixtures::equipe_1);
        $equipe2 = $this->getReference (EquipeFixtures::equipe_2);

        $joueur1 = new Joueurs();
        $joueur1->setName ('messi')
            ->setLastname ('lionel')
            ->setStatus ('titulaire')
            ->setSport ($sport)
            ->setEquipe ($equipe1);

        $manager->persist ($joueur1);

        $joueur2 = new Joueurs();
        $joueur2->setName ('Benzima')
                ->setLastname ('karim')
                ->setStatus ('titulaire')
                ->setSport ($sport)
                ->setEquipe ($equipe2);

        $manager->persist ($joueur2);

        $manager->flush ();



    }

    public function getDependencies () : array
    {
        return [
            SportFixtures::class,
            EquipeFixtures::class
        ];
    }
}