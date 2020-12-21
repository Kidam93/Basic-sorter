<?php
namespace App\Tests;

use App\Entity\Card;
use App\DataFixtures\CardFixtures;
use App\Repository\CardRepository;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase{

    use FixturesTrait;

    public function testTestsAreWorking(){
        $this->assertEquals(2, 1+1);
    }

}