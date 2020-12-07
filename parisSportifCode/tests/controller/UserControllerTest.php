<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function testHelloPage()
    {
        $client = static ::createClient ();
        $client->request ('GET', '/hello');
        $this->assertResponseStatusCodeSame (Response::HTTP_OK);
    }

    public function testH1HelloPage()
    {
        $client = static ::createClient ();
        $client->request ('GET', '/hello');
        $this->assertSelectorTextContains ('h1', 'Bienvenue sur mon site');

    }

    public function testRedirectTologin ()
    {
        $client = static ::createClient ();
        $client->request ('GET', '/auth');
        $this->assertResponseRedirects ('/login');
    }

}