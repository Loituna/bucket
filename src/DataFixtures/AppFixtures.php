<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
     $this->addWish($manager);
    }

    public function addWish(ObjectManager $manager){
        $generator = Factory::create('fr_FR');

        for  ($i=0;$i<10;$i++){

            $wish= new Wish();

            $wish->setAuthor($generator->firstName)
            ->setDescription(implode($generator->words))
                ->setTitle(implode($generator->words))
                ->setDateCreated($generator->dateTime)
                ->setIsPublished($generator->boolean(80));

        $manager->persist($wish);
        }$manager->flush();
    }




}
