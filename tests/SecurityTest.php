<?php
namespace App\Tests;

use App\Entity\Admin;
use App\DataFixtures\AdminFixtures;
use App\Repository\AdminRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SecurityTest extends WebTestCase{

    use FixturesTrait;

    const USERNAME = "demo";

    /**
     * Vérifie qu'il n'y a qu'un seul administrateur
     */
    public function testCountAuth(){
        self::bootKernel();
        $this->loadFixtures([AdminFixtures::class]);
        $admin = self::$container->get(AdminRepository::class)->count([]);
        $this->assertEquals(1, $admin);
    }

    /**
     * Vérifie que l'enregistrement est correcte
     */
    public function testValidEntity(){
        $this->assertHasErrors($this->getEntity(), 0);
    }

    /**
     * Vérifie que l'enregistrement est incorrecte
     */
    public function testInValidEntity(){
        $this->assertHasErrors($this->getEntity()->setPassword('1234567'), 1);
    }

    public function testInvalidBlankEntity(){
        $this->assertHasErrors($this->getEntity()->setPassword(''), 1);
    }

    private function getEntity(){
        return (new Admin())
            ->setUsername('demo')
            ->setPassword('12345678');
    }

    private function assertHasErrors($admin, $number){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($admin);
        return $this->assertCount($number, $error);
    }
}