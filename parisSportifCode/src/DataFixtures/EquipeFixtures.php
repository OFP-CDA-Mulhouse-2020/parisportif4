<?php


namespace App\DataFixtures;


use App\Entity\Equipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{

    public const equipe_1 ="equipe_1";
    public const equipe_2 ="equipe_2";

    /**
     * @inheritDoc
     */
    public function load ( ObjectManager $manager )
    {
        $sport = $this->getReference (SportFixtures::sport_1);
        $equipe1 = new Equipe();


        $equipe1->setName ('barcelonne')
        ->setSport ($sport);

        $manager->persist ($equipe1);



        $equipe2 = new Equipe();

        $equipe2->setName ('real madrid')
            ->setSport ($sport);

        $manager->persist ($equipe2);

        $this->addReference (self::equipe_1,$equipe1);
        $this->addReference (self::equipe_2,$equipe2);

        $manager->flush ();


    }

    public function getDependencies(): array
    {
        return [
            SportFixtures::class
        ];
    }
}