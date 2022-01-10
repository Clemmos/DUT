<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\Formation;

class ProstagesController extends AbstractController
{
    /**
     * @Route("/", name="prostages_accueil ")
     */
    public function index(): Response
    {
        return $this->render('prostages/index.html.twig');
    }
    /**
     * @Route("/entreprises", name="prostages_entreprises")
     */
    public function afficherEntreprises(): Response
    {
        //pour la liste des entreprises qui proposent un stage
        $repository = $this->getDoctrine()->getRepository(Entreprise::class);

        $listeEntreprises = $repository->findAll(); 

        return $this->render('prostages/affichageEntreprises.html.twig', [ 'listeEntreprises' => $listeEntreprises ]);
    }
     /**
     * @Route("/entreprise/{id}", name="prostages_stages_entreprise")
     */
    public function afficherStagesEntreprise($id): Response
    {
        //pour la liste des stages d'une entreprise
        $repository = $this->getDoctrine()->getRepository(Entreprise::class);
        $entreprise = $repository->find($id);

        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);
        $stages = $repositoryStage->findBy(['Entreprise' => $entreprise]);
        return $this->render('prostages/affichageStagesEntreprise.html.twig', 
            [
                'entreprise' => $entreprise,
                'stages' => $stages
            ]);
    }

    /**
     * @Route("/formations", name="prostages_formations")
     */
    public function afficherFormations(): Response
    {
        //pour la listes des formations existantes pour l'IUT
        $repository = $this->getDoctrine()->getRepository(Formation::class);

        $listeFormations = $repository->findAll(); 
        return $this->render('prostages/affichageFormations.html.twig', ['listeFormations' => $listeFormations ]);
    }
    /**
     * @Route("/formation/{id}", name="prostages_stages_formation")
     */
    public function afficherStagesFormation($id): Response
    {
        //pour la liste des stages pour une formation donnée
        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
        $formation = $repositoryFormation->find($id);

        return $this->render('prostages/affichageStagesFormation.html.twig', ['formation' => $formation]);
    }
    /**
     * @Route("/stages/{id}", name="prostages_stages_id")
     */
    public function afficherStages($id): Response
    {
        //pour la description complete d'un stage donné
        $repository = $this->getDoctrine()->getRepository(Stage::class);
        $stage = $repository->findOneBy(['id' => $id]);


        $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
        $formations = $repositoryFormation->findAll();
        

        return $this->render('prostages/affichageStages.html.twig',
        [
            'stage'=> $stage
        ]);
    }
    /**
     * @Route("/stages", name="prostages_stages")
     */
    public function afficherListeStages(): Response
    {
        //pour la liste de tous les stages
        $repository = $this->getDoctrine()->getRepository(Stage::class);
        $listeStages = $repository->findAll();


        return $this->render('prostages/affichageListeStages.html.twig', ['listeStages' => $listeStages]);
    }
   
}
