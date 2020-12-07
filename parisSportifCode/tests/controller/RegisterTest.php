<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegisterTest extends WebTestCase
{

    public function testDisplayLogin ()
    {
        $client = static ::createClient ();
        $crawler = $client->request ('GET', '/register');
        $this->assertResponseStatusCodeSame (Response::HTTP_OK);
        $this->assertSelectorTextContains ('h1', 'Register');
        $this->assertCount(1,$crawler->filter('form input[name="refisteruser[email]"]'));
        $this->assertCount(1,$crawler->filter('form input[name="refisteruser[plainPassword][first]"]'));
        $this->assertCount(1,$crawler->filter('form input[name="refisteruser[plainPassword][second]"]'));
    }



}