<?php

namespace App\Tests\Entity;

use App\Entity\SportIndividuel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SportIndividuelTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function testInstanceSportIndividuel()
    {
        $SportIndividuel = new SportIndividuel();
        $this->assertInstanceOf(SportIndividuel::class, $SportIndividuel);
    }
}
