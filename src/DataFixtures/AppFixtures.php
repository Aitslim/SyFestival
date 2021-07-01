<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordencoder;

    public function __construct(UserPasswordEncoderInterface $passwordencoder)
    {
        $this->passwordencoder = $passwordencoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // create 2 Users !
        // Users 1
        $user = new User();
        $user->setEmail('toto7@gmail.com')
            ->setPassword($this->passwordencoder->encodePassword($user, 'toto123456'));
        $manager->persist($user);

        // User 2
        $user = new User();
        $user->setEmail('toto8@gmail.com')
            ->setPassword($this->passwordencoder->encodePassword($user, 'toto123456'));
        $manager->persist($user);

        // create 5 Categorie !
        $categorieName = ['Mélodique', 'Industrielle', 'Groovy', 'Deep', 'Détroit'];
        $categorieColor = ['primary', 'secondary', 'success', 'info', 'warning'];
        $enconcert = 1;

        for ($i = 0; $i <= 4; $i++) {
            $category = new Category();
            $category->setName($categorieName[$i]);
            $category->setColor($categorieColor[$i]);
            $manager->persist($category);

            // create x Artistes !
            for ($j = 0; $j <= rand(3, 8); $j++) {

                $artiste = new Artist();
                $artiste->setName($faker->firstname())
                    ->setDescription($faker->paragraphs(10, true))
                    ->setCategory($category);

                if ($enconcert <= 9 && rand(0, 5) <= 2) {
                    $artiste->setEnconcert($enconcert);
                    $enconcert++;
                }

                $manager->persist($artiste);
            }
        }

        $manager->flush();
    }
}
