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
            $nbAleatoireFormation = $faker->numberBetween($min = 1, $max = 3);

            //creation d'un stage a partir de valeurs aléatoires
            $stageAleatoire = new Stage();

            $stageAleatoire->setTitre($faker->realText($maxNbChars = 30, $indexSize = 2));
            $stageAleatoire->setDescriptionMission($faker->realText($maxNbChars = 250, $indexSize = 2));
            $stageAleatoire->setEmailContact($faker->safeEmail);

            //lier le stage à une entrepries aléatoire
            $stageAleatoire->setEntreprise($tabEntreprise[$nbAleatoireEntreprise]);
            $nbAleaDejaSorti = array();

            
            //lier le stage à entre 1 et 3 formations aléatoires
            $estDejaSorti = FALSE;
            for($j = 0; $j<$nbAleatoireFormation; $j++){
                //numero de la formation aleatoire
                $nbAleatoireFormation = $faker->numberBetween($min = 0, $max = 2);

                //si la formation n'a pas encore été ajouter on ajouter la formation au stage
                foreach ($nbAleaDejaSorti as $nombre){
                    if($nombre == $nbAleatoireFormation)
                    {
                        $estDejaSorti = TRUE;
                    }
                }
                if( ! $estDejaSorti){
                    $stageAleatoire->addFormation($tabFormations[$nbAleatoireFormation]);
                }
                $estDejaSorti = FALSE;
                array_push($nbAleaDejaSorti,$nbAleatoireFormation);
            }

            $manager->persist($stageAleatoire);
        }

        $manager->persist($formationDUTInfo);
        $manager->persist($formationLPNum);
        $manager->persist($formationLPProg);
        $manager->flush();
    }
}
