<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        $entrepriseAleatoire = new Entreprise();
        $entrepriseAleatoire->setNom($faker->company);
        $entrepriseAleatoire->setAdresse($faker->address);
        $entrepriseAleatoire->setActivite("activite");
        $entrepriseAleatoire->setUrlSite("test");
        $manager->persist($entrepriseAleatoire);

        $manager->flush();
    }
}
