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
    }

    /**
     * @dataProvider providerInvalidCredit
     * @param $credit
     */
    public function testInvalidCredit ($credit)
    {
        $wallet = new Wallet();
        $wallet->setCredit($credit);
        $errors = $this->validator->validate($wallet);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function providerInvalidCredit()
    {
        return [
            [-254]
        ];
    }

    /**
     * @dataProvider providerValidCredit
     * @param $credit
     */
    public function testValidCredit ($credit)
    {
        $wallet = new Wallet();
        $wallet->setCredit($credit);
        $errors = $this->validator->validate($wallet);
        $this->assertEquals(0, count($errors));
    }

    public function providerValidCredit()
    {
        return [
            [0],
            [10.99],
            [254]
        ];
    }


}