<?php
namespace App\Tests\Entity;

use App\Entity\Card;
use App\DataFixtures\CardFixtures;
use App\Repository\CardRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CardTest extends KernelTestCase{

    use FixturesTrait;

    /**
     * Verifie le nombre de cards
     */
    public function testCount(){
        self::bootKernel();
        $this->loadFixtures([CardFixtures::class]);
        $cards = self::$container->get(CardRepository::class)->count([]);
        $this->assertEquals(3, $cards);
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
        $this->assertHasErrors($this->getEntity()->setDescription('azertyuio'), 1);
    }

    public function testInvalidBlankEntity(){
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
    }

    private function getEntity(){
        return (new Card())
            ->setTitle('aze')
            ->setDescription('azertyuiop');
    }

    private function assertHasErrors($card, $number){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($card);
        return $this->assertCount($number, $error);
    }
}