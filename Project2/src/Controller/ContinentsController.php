<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Repository\ContinentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContinentsController extends AbstractController
{
    /**
     * @Route("/continents", name="continents")
     */
    public function index(ContinentRepository $repository)
    {
        $continents = $repository->findAll();
        return $this->render('continents/continents.html.twig', [
            'continents' => $continents,
        ]);
    }
    /**
     * @Route("/continent/{id}", name="afficher_continent")
     */
    public function afficher_continent(Continent $continent)
    {
        return $this->render('continents/afficherContinents.html.twig',
            ["continent"=> $continent
            ]);
    }
}
