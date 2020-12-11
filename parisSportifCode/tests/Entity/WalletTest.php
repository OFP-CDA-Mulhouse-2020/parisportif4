<?php


namespace App\Tests\Entity;


use App\Entity\Wallet;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WalletTest extends KernelTestCase
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
        $wallet = new Wallet();
        $this->assertInstanceOf(Wallet::class, $wallet);
        $this->assertClassHasAttribute("credit", Wallet::class);
        $this->assertClassHasAttribute("addMoney", Wallet::class);
    }


    /**
     * @dataProvider providerAddMoney
     * @param $money
     */
    public function testAddMoney($money)
    {
        $wallet = new Wallet();
        self::assertSame (0,$wallet->getCredit ());
        $wallet->AddMoney ($money);
        $errors = $this->validator->validate($wallet);
        $this->assertEquals(0, count($errors));
        self::assertSame ($money*100,$wallet->getCredit ());
        self::assertSame ($money*100,$wallet->getAddMoney ());


    }
    public function providerAddMoney ()
    {
        return [
            [500],
            [200],
            [10]
        ];
    }

    /**
     * @dataProvider providerInvalidAddMoney
     * @param $money
     */
    public function testInvalidAddMoney($money)
    {
        $wallet = new Wallet();
        self::assertSame (0,$wallet->getCredit ());
        $wallet->AddMoney ($money);
        $errors = $this->validator->validate($wallet);
        $this->assertGreaterThanOrEqual(1, count($errors));


    }
    public function providerInvalidAddMoney ()
    {
        return [
            [0],
            [501],
            [-200]
        ];
    }



}