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
        $this->assertClassHasAttribute("beginDate", EvenementSport::class);
        $this->assertClassHasAttribute("lieu", EvenementSport::class);
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
     * @param $beginDate
     * @dataProvider provideInvalidBirthDateValues
     */
    public function testInvalidBirthDate($beginDate)
    {
        $user = new EvenementSport();
        $user->setBeginDate($beginDate);
        $errors = $this->validator->validate($user, null, "beginDate");
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

    /**
     * @dataprovider provideLieuValues
     * @param $lieu
     */
    public function testLieuValid($lieu)
    {
        $event = new EvenementSport();
        $event->setLieu($lieu);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertGreaterThanOrEqual(0, count($errors));
    }

    public function provideLieuValues(): array
    {
        return [
            ['Colmar'],
            ['COLMAR'],
            ['marseille '],
            ['brive-la-gayarde'],
        ];
    }

    /**
     * @dataprovider provideInvalidLieuValues
     * @param $lieu
     */
    public function testInvalidLieu($lieu)
    {
        $event = new EvenementSport();
        $event->setLieu($lieu);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertGreaterThanOrEqual(0, count($errors));
    }

    public function provideInvalidLieuValues(): array
    {
        return [
            [''],
            ['COLMAR23'],
        ];
    }
}
