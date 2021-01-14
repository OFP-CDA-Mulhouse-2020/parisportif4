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
        $client->loginUser($testUser);

        $client->request('GET', '/auth');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testLabelProfile()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth');
        $this->assertSelectorTextContains('title', 'Hello PageContollerController!');
        $this->assertEquals(4, $crawler->filter('nav div div a.nav-item')->count());
        $this->assertSelectorTextContains('nav div div a.nav-item', 'Home');
        $this->assertSelectorTextContains('', 'Features');
        $this->assertSelectorTextContains('', 'Pricing');
        $this->assertSelectorTextContains('', 'Disabled');
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
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth');
        $this->assertEquals(4, $crawler->filter('div h5')->count());
    }

    public function testProfileEdit()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);
        $client->request('GET', '/auth/edit');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testProfileEditPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);
        $client->request('GET', '/auth/edit/password');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testLabelProfileEditPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/password');
        $this->assertCount(1, $crawler->filter('form input[name="edit_user_password[oldPassword]"]'));
        $this->assertCount(1, $crawler->filter('form input[name="edit_user_password[plainPassword][first]"]'));
        $this->assertCount(1, $crawler->filter('form input[name="edit_user_password[plainPassword][second]"]'));
    }

    public function testProfileEditPasswordBlankInput()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/password');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_password[oldPassword]'] = '';
        $form['edit_user_password[plainPassword][first]'] = '';
        $form['edit_user_password[plainPassword][second]'] = '';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }

    public function testNotSamePassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/password');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_password[oldPassword]'] = 'Sissouf123456';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Mohammed123456';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }

    public function testWrongPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/password');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();

        $form['edit_user_password[oldPassword]'] = 'wrongPassword';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Sofiane123456';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }
    public function testEditPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/password');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();

        $form['edit_user_password[oldPassword]'] = 'Sissouf123456';
        $form['edit_user_password[plainPassword][first]'] = 'Sofiane123456';
        $form['edit_user_password[plainPassword][second]'] = 'Sofiane123456';

        $client->submit($form);
        $this->assertSelectorExists('.alert-success');
    }

    public function testProfileEditEmail()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);
        $client->request('GET', '/auth/edit/email');
        $this->assertResponseStatusCodeSame(200);
    }
    public function testLabelProfileEditEmail()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/email');
        $this->assertCount(1, $crawler->filter('form input[name="edit_user_email[email]"]'));
        $this->assertCount(1, $crawler->filter('form input[name="edit_user_email[plainPassword]"]'));
    }
    public function testProfileEditEmailBlankInput()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/email');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_email[email]'] = 'sofiane6@gmail.com';
        $form['edit_user_email[plainPassword]'] = '';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }

    public function testProfileEditEmailFail()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/email');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_email[email]'] = 'sofiane6@gmail';
        $form['edit_user_email[plainPassword]'] = 'Sofiane123456';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }

    public function testProfileEditEmailFailPassword()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/email');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_email[email]'] = 'sofiane16@gmail';
        $form['edit_user_email[plainPassword]'] = 'Sofiane1234567';

        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('ul li');
    }

    public function testProfileEditEmailValid()
    {
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('sofiane6@gmail.com');
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/auth/edit/email');
        $buttonCrawlerNode = $crawler->selectButton('Valider');
        $form = $buttonCrawlerNode->form();
        $form['edit_user_email[email]'] = 'sofiane16@gmail.com';
        $form['edit_user_email[plainPassword]'] = 'Sofiane123456';

        $client->submit($form);
        $this->assertSelectorExists('.alert-success');
    }
}
