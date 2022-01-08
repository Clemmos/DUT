<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Création d'un générateur de données Faker
        $faker = \Faker\Factory::create('fr_FR');

        //creation des données de Entreprise
        $tabEntreprise = array();
        for($i = 0; $i < 10; $i++){

            $nomEntreprise = $faker->company;
            $idEntreprise = $i+1;

            $entrepriseAleatoire = new Entreprise();
            $entrepriseAleatoire->setNom($nomEntreprise);
            $entrepriseAleatoire->setAdresse($faker->address);
            $entrepriseAleatoire->setActivite("activite");
            $entrepriseAleatoire->setUrlSite("https://siteEtreprise".$idEntreprise);

            array_push($tabEntreprise,$entrepriseAleatoire);

            $manager->persist($entrepriseAleatoire);

            //creation de formation
            
            //creation de la relation entre stage et formation
            
            //creation de la relation entre stage et entreprise
        }
        //creation des Formations
        $formationDUTInfo = new Formation();
        $formationDUTInfo->setNomLong("DUT informatique");
        $formationDUTInfo->setNomCourt("DUT info");

        $formationLPNum = new Formation();
        $formationLPNum->setNomLong("Licence Professionnelle Métiers du Numérique");
        $formationLPNum->setNomCourt("LP Num");
        

        $formationLPProg = new Formation();
        $formationLPProg->setNomLong("Licence Professsionnelle Programmation avancée");
        $formationLPProg->setNomCourt("LP Prog");

        $tabFormations = array($formationDUTInfo,$formationLPNum,$formationLPProg);
        //creation des données de Stage
        for($i = 0; $i < 20; $i++){

            $nbAleatoireEntreprise = $faker->numberBetween($min = 0, $max = 9);
            $nbAleatoireFormation = $faker->numberBetween($min = 0, $max = 2);

            //creation d'un stage a partir de valeurs aléatoires
            $stageAleatoire = new Stage();

            $stageAleatoire->setTitre($faker->realText($maxNbChars = 30, $indexSize = 2));
            $stageAleatoire->setDescriptionMission($faker->realText($maxNbChars = 250, $indexSize = 2));
            $stageAleatoire->setEmailContact($faker->safeEmail);

            //lier le stage à une entrepries aléatoire
            $stageAleatoire->setEntreprise($tabEntreprise[$nbAleatoireEntreprise]);
            //lier le stage à une formation aléatoire
            $stageAleatoire->addFormation($tabFormations[$nbAleatoireFormation]);
            

            $manager->persist($stageAleatoire);
        }

        $manager->persist($formationDUTInfo);
        $manager->persist($formationLPNum);
        $manager->persist($formationLPProg);
        $manager->flush();
    }
}
