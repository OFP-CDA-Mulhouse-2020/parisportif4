<?php

namespace App\Tests\Entity;

use App\Entity\Joueurs;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JoueursTest extends KernelTestCase
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
    public function joueursInstance()
    {
        $event = new Joueurs();
        $this->assertInstanceOf(Joueurs::class, $event);
        $this->assertClassHasAttribute("name", Joueurs::class);
    }

    /**
     * @test
     * @dataProvider provideTestValidName
     * @param $name
     */
    public function testValidName($name)
    {
        $event = new Joueurs();
        $event->setName($name);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertEquals(0, count($errors));
    }

    public function provideTestValidName(): array
    {
        return [
            ['mohamed'],
            ['MOHAMED'],
            ['MOHAMED MOHAMED']
        ];
    }

    /**
     * @test
     * @dataProvider provideTestInvalidName
     * @param $name
     */
    public function testInvalidName($name)
    {
        $event = new Joueurs();
        $event->setName($name);
        $errors = $this->validator->validate($event, null, "naming");
        $this->assertEquals(0, count($errors));
    }

    public function provideTestInvalidName(): array
    {
        return [
            [''],
            ['MOHAMED '],
            ['MOHAMED123']
        ];
    }

    /**
     * @test
     * @dataProvider provideTestValidPrenom
     * @param $prenom
     */
    public function testValidPrenom($prenom)
    {
        $joueurs = new Joueurs();
        $joueurs->setName($prenom);
        $errors = $this->validator->validate($joueurs, null, "naming");
        $this->assertEquals(0, count($errors));
    }

    public function provideTestValidPrenom(): array
    {
        return [
            ['KAIZERLI'],
            ['MAMADOU-SAKO'],
            ['JEAN-NEYMAR']
        ];
    }

    /**
     * @test
     * @dataProvider provideTestInvalidPrenom
     * @param $prenom
     */
    public function testInvalidPrenom($prenom)
    {
        $joueurs = new Joueurs();
        $joueurs->setName($prenom);
        $errors = $this->validator->validate($joueurs, null, "naming");
        $this->assertEquals(0, count($errors));
    }

    public function provideTestInvalidPrenom(): array
    {
        return [
            [''],
            ['NEYMAR  '],
            ['NEYMAR']
        ];
    }


}
