<?php

namespace App\Controller;

use App\Repository\FamilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FamilleController extends AbstractController
{
    /**
     * @Route("/familles", name="familles")
     */
   public function index(FamilleRepository $repository)
    {
        $familles = $repository->findAll();
        return $this->render('famille/index.html.twig', [
            'familles' => $familles,
        ]);
    }
    
}
