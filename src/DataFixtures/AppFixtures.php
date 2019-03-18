<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ad;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   
        $faker = Factory::create('FR-fr');
    


        for ($i = 1; $i <= 10; $i++) {
        $ad = new Ad();

        $title = $faker->word();
        $image = $faker->imageUrl(150,150);
        $duree = $faker->dateTime($max = 'now');
        $genre = $faker->word;
 
        $ad->setTitle($title)
            ->setPrice(mt_rand(0.99,1.99))
            ->setGenre($genre)
            ->setDuree($duree)
            ->setTduree(mt_rand(00.30,5.55))
            ->setAnnee(mt_rand (2007,2019))
            ->setImage($image);
          
        
        $manager->persist($ad);
    }
        $manager->flush();
    }
}
