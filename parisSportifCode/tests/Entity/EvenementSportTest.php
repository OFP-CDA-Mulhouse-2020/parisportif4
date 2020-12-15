<?php

namespace App\Tests\Entity;

use App\Entity\EvenementSport;
use DateTime;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EvenementSportTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    /**
     * @test
     */
    public function eventInstance()
    {
        $event = new EvenementSport();
        $this->assertInstanceOf(EvenementSport::class, $event);
        $this->assertClassHasAttribute("name", EvenementSport::class);
        $this->assertClassHasAttribute("birthDate", EvenementSport::class);
    }

    /**
     * @test
     * @dataProvider provideTestValidName
     * @param $name
     */
    public function testValidName($name)
    {
        $event = new EvenementSport();
        $event->setName($name);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertEquals(0, count($errors));
    }

    public function provideTestValidName(): array
    {
        return [
            ['football'],
            ['FOOTBALL'],
        ];
    }

    /**
     * @param $name
     * @dataProvider invalidTestName
     */
    public function testInvalidName($name)
    {
        $event = new EvenementSport();
        $event->setName($name);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertGreaterThanOrEqual(0, count($errors));
    }

    public function invalidTestName(): array
    {
        return [
            [''],
            ['FOOTBALL1'],
            ['football '],
            ['football football'],
        ];
    }

    /**
     * @param $birthDate
     * @dataProvider provideInvalidBirthDateValues
     */
    public function testInvalidBirthDate($birthDate)
    {
        $user = new EvenementSport();
        $user->setBirthDate($birthDate);
        $errors = $this->validator->validate($user, null, "birthDate");
        $this->assertGreaterThanOrEqual(0, count($errors));
    }

    public function provideInvalidBirthDateValues(): array
    {
        return [
            [DateTime::createFromFormat('Y-m-d', '2008-01-04')],
            [DateTime::createFromFormat('Y-m-d', '2010-01-04')],
            [DateTime::createFromFormat('Y-m-d', '2004-01-04')],
        ];
    }
}
