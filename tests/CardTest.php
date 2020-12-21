<?php
namespace App\Tests;

use App\DataFixtures\CardFixtures;
use App\Repository\CardRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardTest extends KernelTestCase{

    use FixturesTrait;

    public function testCount(){
        self::bootKernel();
        $this->loadFixtures([CardFixtures::class]);
        $cards = self::$container->get(CardRepository::class)->count([]);
        $this->assertEquals(3, $cards);
    }

}