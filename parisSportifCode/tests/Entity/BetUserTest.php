<?php


namespace App\Tests\Entity;


use App\Entity\BetUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BetUserTest extends KernelTestCase
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
        $betUser = new BetUser();
        $this->assertInstanceOf (BetUser::class, $betUser);
        $this->assertClassHasAttribute ("createDate", BetUser::class);
        $this->assertClassHasAttribute ("amountBet", BetUser::class);
    }

    /**
     * @dataProvider providerInvalidAmountBet
     * @param $amountBet
     */
    public function testInvalidAmountBet ($amountBet)
    {
        $betUser = new BetUser();
        $betUser->setAmountBet ($amountBet);
        $errors = $this->validator->validate($betUser);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function providerInvalidAmountBet ()
    {
        return [
            [0],
            [10001],
            [-1000]
        ];
    }

    /**
     * @dataProvider providerValidAmountBet
     * @param $amountBet
     */
    public function testValidAmountBet ($amountBet)
    {
        $betUser = new BetUser();
        $betUser->setAmountBet ($amountBet);
        $errors = $this->validator->validate($betUser);
        $this->assertEquals(0, count($errors));
    }

    public function providerValidAmountBet ()
    {
        return [
            [100],
        ];
    }

}