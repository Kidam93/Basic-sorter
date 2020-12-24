<?php
namespace App\Tests\Controller;

use App\Entity\Admin;
use App\DataFixtures\AdminFixtures;
use App\Repository\AdminRepository;
use Symfony\Component\HttpFoundation\Response;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SecurityControllerTest extends WebTestCase{

    public function testPageLogin(){
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h3', 'Se connecter');
    }

    public function testLoginWithGoodCredentials(){
        $hash = password_hash('demo', PASSWORD_BCRYPT);
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Submit')->form([
            '_username' => 'demo',
            '_password' => $hash
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(302);
    }
}