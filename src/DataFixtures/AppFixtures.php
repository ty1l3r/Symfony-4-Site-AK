<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Comment;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
        
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {   
        $faker = Factory::create('FR-fr');

        // mode Admin
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('Fabien')
                  ->setLastName('Coll')
                  ->setEmail('h4kh4@outlook.fr')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->setPicture('https://randomuser.me/api/portraits/men/86.jpg')
                  ->setIntroduction($faker->realText($maxNbChars = 250, $indexSize = 2))
                  ->addUserRole($adminRole);

        $manager->persist($adminUser);


        //nous gérons les utilisateurs

        $users = [];
        $genres = ['male','female'];

        for ($i = 1; $i <= 10; $i++) 
        {
          $user = new User();

          $genre = $faker->randomElement($genres);

          $picture = 'https://randomuser.me/api/portraits/';
          $pictureId = $faker->numberBetween(1,99) .'.jpg';

         
          $picture .= ($genre == 'male' ? 'men/' : 'women/'). $pictureId;

          $hash = $this->encoder->encodePassword($user,'password');

          
          $user->setFirstName($faker->firstname($genre))
             ->setLastName($faker->lastname)
             ->setEmail($faker->email)
             ->setIntroduction($faker->realText($maxNbChars = 250, $indexSize = 2))
             ->setHash($hash)
             ->setPicture($picture);

             $manager->persist($user);
             $users[] = $user;
        }

        //nous gérons les annonces
        for ($i = 1; $i <= 20; $i++) {
        $ad = new Ad();
        $width=250;
        $height=250;

        $title = $faker->sentence($nbWords = 1);
        $image = $faker->imageUrl($width,$height,'nightlife');
        $duree = $faker->dateTime($max = 'now');
        $genre = $faker->word;
 
        $user = $users[mt_rand(0, count($users)-1)];

        $ad->setTitle($title)
            ->setPrice(mt_rand(0.99,1.99))
            ->setGenre($genre)
            ->setDuree($duree)
            ->setAnnee(mt_rand (2007,2019))
            ->setImage($image)
            ->setAuthor($user);
          
        
        $manager->persist($ad);

        //Gestion des commentaires
        
           $comment = new Comment();
           $comment->setContent($faker->paragraph())
                   ->setRating(mt_rand(1,5))
                   ->setAuthor($users[mt_rand(0, count($users)-1)])
                   ->setAd($ad);
                   
            $manager->persist($comment);
    }
        $manager->flush();
    }
}
