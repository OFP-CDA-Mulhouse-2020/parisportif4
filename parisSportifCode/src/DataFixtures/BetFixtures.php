<?php


namespace App\DataFixtures;


use App\Entity\Bet;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BetFixtures extends Fixture implements DependentFixtureInterface
{

    public function load ( ObjectManager $manager )
    {
        $evenement = $this->getReference (EvenementFixtures::evenement_1);
        $bet = new Bet();
        $bet->setNameBet ('victoire Barcelone');
        $bet->setCote (1.20);
        $bet->setDateBetLimit((new DateTime())->add(new DateInterval('P2D')));
        $bet->setEvenement ($evenement);
        $manager->persist ($bet);

        $bet1 = new Bet();
        $bet1->setNameBet ('victoire Liverpool');
        $bet1->setCote (2.20);
        $bet1->setDateBetLimit((new DateTime())->add(new DateInterval('P2D')));
        $bet1->setEvenement ($evenement);
        $manager->persist ($bet1);

        $bet2 = new Bet();
        $bet2->setNameBet ('match null Barcelonne vs Liverpool');
        $bet2->setCote (3);
        $bet2->setDateBetLimit((new DateTime())->add(new DateInterval('P2D')));
        $bet2->setEvenement ($evenement);
        $manager->persist ($bet2);

        $manager->flush ();

    }

    public function getDependencies ()
    {
        return [
          EvenementFixtures::class
        ];
    }
}