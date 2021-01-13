<?php


namespace App\Tests\controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProfileTest extends WebTestCase
{
    public function testResponseProfile()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $client->request('GET', '/auth');
        $this->assertResponseStatusCodeSame(200);


    }

    public function testLabelProfile()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth');
        $this->assertSelectorTextContains ('title', 'Hello PageContollerController!');
        $this->assertEquals(4, $crawler->filter('nav div div a.nav-item')->count());
        $this->assertSelectorTextContains('nav div div a.nav-item', 'Home');
        $this->assertSelectorTextContains('', 'Features');
        $this->assertSelectorTextContains('', 'Pricing');
        $this->assertSelectorTextContains('', 'Disabled');
        $this->assertEquals(3, $crawler->filter('button')->count());
        $this->assertEquals(4, $crawler->filter('div h6.mb-0')->count());
        $this->assertEquals(1, $crawler->filter('img')->count());
        $this->assertSelectorTextContains('h6', 'Full Name');
        $this->assertSelectorTextContains('', 'Email');
        $this->assertSelectorTextContains('', 'Phone');
        $this->assertSelectorTextContains('', 'Address');
    }

    public function testValidInformation()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth');
        $this->assertEquals(4, $crawler->filter('div h5')->count());

    }

    public function testProfileEdit()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);
        $client->request('GET', '/auth/edit');
        $this->assertResponseStatusCodeSame(200);

    }

    public function testLabelProfileEdit()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth/edit');
        $this->assertCount(1,$crawler->filter('form input[name="edit_user_password[oldPassword]"]'));
        $this->assertCount(1,$crawler->filter('form input[name="edit_user_password[plainPassword][first]"]'));
        $this->assertCount(1,$crawler->filter('form input[name="edit_user_password[plainPassword][second]"]'));

    }

    public function testBlankInput()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth/edit');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_password[oldPassword]'] = '';
        $form['edit_user_password[plainPassword][first]'] = '';
        $form['edit_user_password[plainPassword][second]'] = '';

        $client->submit ($form);
        $this->assertResponseStatusCodeSame (Response::HTTP_OK);
        $this->assertSelectorExists('ul li');

    }

    public function testNotSamePassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth/edit');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_password[oldPassword]'] = 'Sissouf123456';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Mohammed123456';

        $client->submit ($form);
        $this->assertResponseStatusCodeSame (Response::HTTP_OK);
        $this->assertSelectorExists('ul li');

    }

    public function testWrongPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth/edit');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();

        $form['edit_user_password[oldPassword]'] = 'wrongPassword';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Sofiane123456';

        $client->submit ($form);
        $this->assertResponseStatusCodeSame (Response::HTTP_OK);
        $this->assertSelectorExists('ul li');

    }
    public function testEditPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser ($testUser);

        $crawler = $client->request('GET', '/auth/edit');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();

        $form['edit_user_password[oldPassword]'] = 'Sissouf123456';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Sofiane123456';

        $client->submit ($form);
        $this->assertSelectorExists('.alert-success');
    }



}