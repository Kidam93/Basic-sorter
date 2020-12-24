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

class AdminControllerTest extends WebTestCase{

    public function testPageAdmin(){
        $client = static::createClient();
        $client->request('GET', '/admin');
        $this->assertResponseStatusCodeSame(302);
    }

    public function testRedirectToLogin(){
        $client = static::createClient();
        $client->request('GET', '/admin');
        $this->assertResponseRedirects('http://localhost/login');
    }
}