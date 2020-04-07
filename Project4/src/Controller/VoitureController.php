<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    /**
     * @Route("/clients/voitures", name="voitures")
     */
    public function afficherVoitures(VoitureRepository $repository)
    {
        $voitures = $repository->findAll();
        return $this->render('voiture/afficherVoitures.html.twig', [
            'voitures'=> $voitures
        ]);
    }
}
