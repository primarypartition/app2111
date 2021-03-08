<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Entity\Video;

class WelcomeControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/welcome');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Hello', $crawler->filter('h1')->text());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello")')->count()
        );

        $this->assertGreaterThan(0, $crawler->filter('h1.class')->count());

        $this->assertCount(1, $crawler->filter('h1'));

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );

        $this->assertContains('foo', $client->getResponse()->getContent());

        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');

        $this->assertTrue($client->getResponse()->isNotFound());

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        $this->assertTrue(
            $client->getResponse()->isRedirect('/demo/contact')
            // if the redirection URL was generated as an absolute URL
            // $client->getResponse()->isRedirect('http://localhost/demo/contact')
        );
        
        $this->assertTrue($client->getResponse()->isRedirect());

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello');
    }

    public function testSomething2()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/welcome');
       
        $link = $crawler
        ->filter('a:contains("awesome link")')
        ->link();

        $crawler = $client->click($link);

        $this->assertContains('Remember me', $client->getResponse()->getContent());   
    }

    public function testSomething3()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/security/login');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = 'user@user.com';
        $form['password'] = 'passw';

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        
        $this->assertEquals(1, $crawler->filter('a:contains("logout")')->count());       
    }

     /**
     * @dataProvider provideUrls
     */
    public function testSomething4($url)
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
   
    }

    public function provideUrls()
    {
        return [
            ['/welcome'],
            ['/security/login']
        ];
    }
}
