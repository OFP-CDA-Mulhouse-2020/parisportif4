<?php


namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testvalidNom()
    {
        $name = new User();
        $name->setNom("Mohamed");
        $this->assertSame("Mohamed",$name->getNom());
    }

    public function testInvalidNom()
    {
        $this->expectException(\InvalidArgumentException::class);
        $name = new User();
        $name->setNom("Mohamed657");
    }
}