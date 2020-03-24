<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    $a1 = new Animal();
    $a1->setNom("Chien")
        ->setDescription("Un animal domestique")
        ->setImage("chien.png")
        ;
    $manager -> persist($a1);
    $a2 = new Animal();
    $a2->setNom("Cochon")
        ->setDescription("Un animal d'elevage")
        ->setImage("cochon.png")
    ;
    $manager -> persist($a2);

    $a3 = new Animal();
    $a3->setNom("Croco")
        ->setDescription("Un animal sauvage")
        ->setImage("croco.png")
    ;
    $manager -> persist($a3);

    $a4 = new Animal();
    $a4->setNom("Requin")
        ->setDescription("Un animal marin")
        ->setImage("requin.png")
    ;
    $manager -> persist($a4);

    $a5 = new Animal();
    $a5->setNom("Serpent")
        ->setDescription("Un animal imprévisible")
        ->setImage("serpent.png")
    ;
    $manager -> persist($a5);
        // $product = new Product();
        // $manager->persist($product);

    $manager->flush();
    }
}
