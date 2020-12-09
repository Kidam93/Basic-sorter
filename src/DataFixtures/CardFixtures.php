<?php

namespace App\DataFixtures;

use App\Entity\Card;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CardFixtures extends Fixture
{
    const LENGTH = 3;

    public function load(ObjectManager $manager){
        $descriptions = ["Ceci est une petite description", 
                            "Cela est une seconde description",
                            "Cela est une dernière description"];

        for($i = 1; $i <= self::LENGTH; $i++){
            $card = new Card();
            $card->setTitle('title '.$i)
                ->setImg('img_'.$i.'.jpeg')
                ->setDescription($descriptions[$i - 1]);
            $manager->persist($card);
        }
        $manager->flush();
    }
}
