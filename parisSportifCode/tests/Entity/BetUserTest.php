<?php


namespace App\Tests\Entity;


use App\Entity\BetUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BetUserTest extends KernelTestCase
{
    private ?object $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function testInstanceOf()
    {
        $betUser = new BetUser();
        $this->assertInstanceOf (BetUser::class, $betUser);
        $this->assertClassHasAttribute ("amountBetDate", BetUser::class);
        $this->assertClassHasAttribute ("amountBet", BetUser::class);
    }

    /**
     * @dataProvider providerInvalidAmountBet
     * @param $amountBet
     */
    public function testInvalidAmountBet ($amountBet)
    {
        $betUser = new BetUser();
        $this->assertEquals(false,$betUser->setAmountBet ($amountBet,100));
    }

    public function providerInvalidAmountBet ()
    {
        return [
            [200],
        ];
    }

    /**
     * @dataProvider providerValidAmountBet
     * @param $amountBet
     */
    public function testValidAmountBet ($amountBet)
    {
        $betUser = new BetUser();
        $betUser->setAmountBet ($amountBet,100);
        $errors = $this->validator->validate($betUser);
        $this->assertEquals(0, count($errors));
        $this->assertEquals(true,$betUser->setAmountBet ($amountBet,100));
    }

    public function providerValidAmountBet ()
    {
        return [
            [100],
        ];
    }

}