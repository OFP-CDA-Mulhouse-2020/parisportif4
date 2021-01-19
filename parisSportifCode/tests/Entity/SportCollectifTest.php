<?php

namespace App\Tests\Entity;

use App\Entity\SportCollectif;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SportCollectifTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function testInstanceOf()
    {
        $sport = new SportCollectif();
        $this->assertInstanceOf(SportCollectif::class, $sport);
    }


    public function testNombresJoueursIsNotNull()
    {
        $sport = new SportCollectif();
        $errors = $this->validator->validate($sport, null, "nbJoueurs");
        $this->assertEquals(0, count($errors));
    }

    public function testNombresJoueursIsInvalid()
    {
        $sport = new SportCollectif();
        $errors = $this->validator->validate($sport, null, "nbJoueurs");
        $this->assertEquals(0, count($errors));
    }
}
