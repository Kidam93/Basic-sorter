<?php

namespace App\DataFixtures;

use App\Entity\Card;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CardFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 3; $i++){
            $card = new Card();
            $card->setTitle('title_'.$i)
                ->setImg('img_'.$i.'jpeg')
                ->setDescription('desc_'.$i);
            $manager->persist($card);
        }
        $manager->flush();
    }
}
