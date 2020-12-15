<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    const USERNAME = "demo";
    const PASSWORD = "demo";

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager){
        $admin = new Admin();
        $admin->setUsername(self::USERNAME)
            ->setPassword($this->encoder->encodePassword($admin, self::PASSWORD));
        $manager->persist($admin);
        $manager->flush();
    }
}