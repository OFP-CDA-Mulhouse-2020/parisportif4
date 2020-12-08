<?php


namespace App\Tests\Entity;


use App\Entity\User;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
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
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
        $this->assertClassHasAttribute("email", User::class);
        $this->assertClassHasAttribute("password", User::class);
        $this->assertClassHasAttribute("lastname", User::class);
        $this->assertClassHasAttribute("firstname", User::class);
        $this->assertClassHasAttribute("email", User::class);
        $this->assertClassHasAttribute("birthDate", User::class);
        $this->assertClassHasAttribute("createDate", User::class);
        $this->assertClassHasAttribute("userValidationDate", User::class);
        $this->assertClassHasAttribute("userSuspended", User::class);
        $this->assertClassHasAttribute("userSuspendedDate", User::class);
        $this->assertClassHasAttribute("userDeleted", User::class);
        $this->assertClassHasAttribute("userDeletedDate", User::class);
    }
    /**
     * @dataProvider ProviderinvalidEmail
     * @param $email
     */
    public function testInvalidEmail($email)
    {
        $user = new User();

        $user->setEmail($email);
        $errors = $this->validator->validate($user);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function ProviderinvalidEmail(): array
    {
        return [
            [""],
            ["namoune@"],
            ["namoune@gmailcom"],
            ["namoune.mohamedSofiane"]
        ];
    }

    /**
     * @dataProvider ProviderValidEmail
     * @param $email
     */
    public function testValidEmail($email)
    {
        $user = new User();

        $user->setEmail($email);
        $errors = $this->validator->validate($user);
        $this->assertEquals(5, count($errors));
    }

    public function ProviderValidEmail(): array
    {
        return [
            ["namoune@gmail.com"],
            ["namoune-mohammed@gmail.com"],
        ];
    }

    /**
     * @param $firstname
     * @dataProvider provideInvalidFirstnameValues
     */
    public function testInvalideFirstnameProperty($firstname)
    {

        $user = new User();
        $user->setFirstname ($firstname);
        $errors = $this->validator->validate($user);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function provideInvalidFirstnameValues()
    {
        return [
            ['sissouf1'],
            [''],
            ['namoune_'],
            ['mohammed sofiane']
        ];
    }

    /**
     * @param $firstname
     * @dataProvider provideValidFirstnameValues
     */
    public function testValidFirstnameProperty($firstname)
    {

        $user = new User();
        $user->setFirstname ($firstname);
        $errors = $this->validator->validate($user);
        $this->assertEquals(5, count($errors));
    }

    public function provideValidFirstnameValues()
    {
        return [
            ['sofiane'],
            ['MOHAMMED'],
            ['mohamed-sofiane'],
        ];
    }

    /**
     * @param $birthDate
     * @dataProvider provideInvalidBirthDateValues
     */
    public function testInvalidBirthDate( $birthDate)
    {
        $user = new User();
        $user->setBirthDate ($birthDate);
        $errors = $this->validator->validate($user);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function provideInvalidBirthDateValues()
    {
        return [
            [DateTime::createFromFormat('Y-m-d', '2008-01-04')],
            [DateTime::createFromFormat('Y-m-d', '2010-01-04')],
            [DateTime::createFromFormat('Y-m-d', '2004-01-04')],
        ];
    }

    /**
     * @param $birthDate
     * @dataProvider provideValidBirthDateValues
     */
    public function testValidBirthDate ($birthDate)
    {
        $user = new User();
        $user->setBirthDate ($birthDate);
        $errors = $this->validator->validate($user);
        $this->assertEquals(5, count($errors));
    }

    public function provideValidBirthDateValues ()
    {
        return [
            [DateTime::createFromFormat('Y-m-d', '1994-01-04')],
            [DateTime::createFromFormat('Y-m-d', '1996-01-04')],
            [DateTime::createFromFormat('Y-m-d', '2000-01-04')],
        ];
    }

    /**
     * @param $createAt
     * @dataProvider provideInvalidCreateAtValues
     */
    public function testInvalidCreateAt ( $createAt)
    {
        $user = new User();
        $user->setCreateDate ($createAt);
        $errors = $this->validator->validate($user);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function provideInvalidCreateAtValues ()
    {
        return [
            [(new DateTime())->sub(new DateInterval('P01Y'))],
            [(new DateTime())->sub(new DateInterval('P10Y'))],
            [(new DateTime())->sub(new DateInterval('P11Y'))],
        ];
    }

    /**
     * @param $password
     * @dataProvider provideInvalidPasswordValues
     */
    public function testInvalidPassword ( $password)
    {
        $user = new User();
        $user->setPlainPassword ($password);
        $errors = $this->validator->validate($user);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function provideInvalidPasswordValues ()
    {
        return [
            ['sissouf'],
            ['sissouf1'],
            ['']
        ];
    }

    /**
     * @param $password
     * @dataProvider provideValidPasswordValues
     */
    public function testValidPassword ( $password)
    {
        $user = new User();
        $user->setPlainPassword ($password);
        $errors = $this->validator->validate($user);
        $this->assertEquals(5, count($errors));
    }

    public function provideValidPasswordValues ()
    {
        return [
            ['Sissouf1'],
            ['Sisssasa7'],
            ['mohAmmedsofiane3']
        ];
    }


}