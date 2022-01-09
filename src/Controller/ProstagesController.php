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
        return $this->render('prostages/affichageEntreprises.html.twig');
    }
    
    /**
     * @Route("/formations", name="prostages_formations")
     */
    public function afficherFormations(): Response
    {
        //pour la listes des formations existantes pour l'IUT
        return $this->render('prostages/affichageFormations.html.twig');
    }

    /**
     * @Route("/stages/{id}", name="prostages_stages_id")
     */
    public function afficherStages($id): Response
    {
        //pour la description complete d'un stage
        return $this->render('prostages/affichageStages.html.twig',[
            'id'=> $id]);
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
