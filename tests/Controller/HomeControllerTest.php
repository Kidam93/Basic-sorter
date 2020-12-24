<?php
namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase{

    public function testPageHome(){
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}