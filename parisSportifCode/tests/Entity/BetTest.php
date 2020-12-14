<?php


namespace App\Tests\Entity;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BetTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

}