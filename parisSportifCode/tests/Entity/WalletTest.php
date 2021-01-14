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
        self::assertSame(0, $wallet->getCredit());
        $wallet->AddMoney($money);
        $errors = $this->validator->validate($wallet);
        $this->assertEquals(0, count($errors));
        self::assertSame((int)($money), $wallet->getCredit());
        self::assertSame((int)($money), $wallet->getAddMoney());
    }
    public function providerAddMoney()
    {
        return [
            [500],
            [200.99],
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
        self::assertSame(0, $wallet->getCredit());
        $wallet->AddMoney($money);
        $errors = $this->validator->validate($wallet);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }
    public function providerInvalidAddMoney()
    {
        return [
            [0],
            [501],
            [-200]
        ];
    }

    /**
     * @dataProvider providerDrawMoney
     * @param $drawMoney
     */
    public function testDrawMoney($drawMoney)
    {
        $wallet = new Wallet();
        $wallet->AddMoney(100);
        $wallet->Drawmoney($drawMoney);
        self::assertEquals(true, $wallet->isValidDrawMoney());
    }

    public function providerDrawMoney()
    {
        return [
          [50]
        ];
    }

    /**
     * @dataProvider providerInvalidDrawMoney
     * @param $drawMoney
     */
    public function testInvalidDrawMoney($drawMoney)
    {
        $wallet = new Wallet();
        $wallet->AddMoney(100);
        $wallet->Drawmoney($drawMoney);
        self::assertEquals(false, $wallet->isValidDrawMoney());
    }

    public function providerInvalidDrawMoney()
    {
        return [
            [200]
        ];
    }

    public function testInWithAddEarnings()
    {
        $wallet = new Wallet();
        $this->assertEquals(false, $wallet->AddEarnings(100, false));
    }

    public function testWithAddEarnings()
    {
        $wallet = new Wallet();
        $this->assertEquals(true, $wallet->AddEarnings(100, true));
    }
}
